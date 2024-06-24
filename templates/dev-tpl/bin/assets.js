const chokidar = require("chokidar");
const path = require("path");
const fsPromises = require("fs/promises");
const svgstore = require("svgstore");
const svgo = require("svgo");
const debounce = require("lodash/debounce");
const sharp = require("sharp");

function watchAssets() {
  const imagesDir = path.resolve(__dirname, "../src/images/");
  const handler = debounce((filename) => {
    const type = getAssetType(filename);

    switch (type) {
      case "svg":
        makeSprite();
        break;
      case "image":
        imageMin();
        break;
    }
  }, 300);

  const watcher = chokidar.watch(imagesDir);
  watcher.on("change", handler);
  watcher.on("unlink", handler);
  watcher.on("add", handler);
}

const getAssetType = (filename) => {
  if (filename.match(/.+\.svg/i) !== null) return "svg";
  if (filename.match(/.+\.(png|jpg|jpeg)/i) !== null) return "image";

  return "unknown";
};

async function makeSprite() {
  const iconsDir = path.resolve(__dirname, "../src/images/");
  const files = await fsPromises.readdir(iconsDir);
  const svgs = files.filter((file) => {
    const found = file.match(/.+\.svg/i);
    return found !== null;
  });
  if (svgs.length === 0) return false;

  const sprite = svgstore();
  for (const svg of svgs) {
    const file = await fsPromises.readFile(path.resolve(iconsDir, svg));
    const isStatic = svg.includes("static");
    const optimized = optimizeSvg(file, !isStatic);
    const split = svg.split(".");
    sprite.add(split[0], optimized);
  }
  const spriteStr = sprite.toString();
  const optimizedSprite = svgo.optimize(spriteStr, {
    plugins: ["removeDoctype", "removeUselessDefs", "removeXMLProcInst"],
  });

  const spriteData = optimizedSprite.data;
  if (!spriteData) return;

  try {
    await fsPromises.writeFile(
      path.resolve(__dirname, "../static/images/sprite.svg"),
      spriteData
    );
  } catch (err) {
    await fsPromises.mkdir(path.resolve(__dirname, "../static/images/"), {
      recursive: true,
    });
    await fsPromises.writeFile(
      path.resolve(__dirname, "../static/images/sprite.svg"),
      spriteData
    );
  }
}

function optimizeSvg(file, removeColors = true) {
  const plugins = [
    {
      name: "preset-default",
      params: {
        overrides: {
          removeViewBox: false,
        },
      },
    },
  ];

  removeColors &&
    plugins.push({
      name: "removeAttrs",
      params: {
        attrs: "(fill|stroke)",
      },
    });

  const optimized = svgo.optimize(file, {
    plugins,
  });

  return optimized.data;
}

async function optimizeJpeg(file) {
  return await sharp(file).jpeg({
    mozjpeg: true,
    quality: 88,
  });
}
async function optimizePNG(file) {
  return await sharp(file).png({
    quality: 88,
  });
}

async function webpConvert(file) {
  return await sharp(file).webp({
    quality: 88,
  });
}

async function imageMin() {
  const imgsDir = path.resolve(__dirname, "../src/images/");
  const files = await fsPromises.readdir(imgsDir);
  const imgs = files.filter((file) => {
    const found = file.match(/.+\.(png|jpg|jpeg)/i);
    return found !== null;
  });
  if (imgs.length === 0) return false;

  const outDir = path.resolve(__dirname, "../static/images/");
  for (const img of imgs) {
    const split = img.split(".");
    const ext = split[1];
    const format = ext === "png" ? "png" : "jpeg";
    const file = await fsPromises.readFile(path.resolve(imgsDir, img));

    let optimized;
    switch (format) {
      case "jpeg":
        optimized = await optimizeJpeg(file);
        break;
      case "png":
        optimized = await optimizePNG(file);
        break;
    }

    optimized.toFile(`${outDir}/${img}`);

    // const webp = await webpConvert(file)
    // webp.toFile(`${outDir}/${img.replace(format, "webp")}`)
  }
}

module.exports = { watchAssets, imageMin };
