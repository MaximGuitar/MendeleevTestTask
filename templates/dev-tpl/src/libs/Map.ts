import { LngLat, YMap, YMapMarkerProps } from "@yandex/ymaps3-types";

interface IMapConstructorProps {
  container: HTMLElement;
  center?: LngLat;
  zoom?: number;
}

export default class Map {
  container: HTMLElement;
  ymap?: YMap | undefined;
  constructor({ container, center, zoom }: IMapConstructorProps) {
    if (!container) throw new Error("Контейнер не определён");

    this.container = container;
    this.createMap(center, zoom);
  }

  private static key = "ca4ab438-ce96-431f-9eb5-8441c2a35bb3";
  private static ymapIsReady = false;
  private static isLoading = false;
  private static loader: Promise<string>;

  static loadAPI() {
    if (!this.isLoading && !this.ymapIsReady) {
      this.loader = this.startLoad();
      return this.loader;
    } else return this.loader;
  }

  private static startLoad() {
    return new Promise<string>((resolve) => {
      this.isLoading = true;
      if (Map.ymapIsReady) {
        this.isLoading = false;
        resolve("loaded");
        return;
      }

      const script = document.createElement("script");
      script.src = `https://api-maps.yandex.ru/v3/?apikey=${this.key}&lang=ru_RU`;
      script.addEventListener("load", async () => {
        await ymaps3.ready;
        Map.ymapIsReady = true;
        this.isLoading = false;
        resolve("loaded");
      });
      document.body.append(script);
    });
  }

  static createDefaultMarker() {
    const marker = document.createElement("div");
    marker.innerHTML = `
			<svg class="icon" width="45" height="56" viewBox="0 0 45 56" fill="none">
				<path d="M45 22.6835C45 35.2113 35.1123 43.2848 22.5 56C9.77609 43.7722 0 35.2113 0 22.6835C0 10.1558 10.0736 0 22.5 0C34.9264 0 45 10.1558 45 22.6835Z" fill="#1C1C1C"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M23.3858 16.0023H21.6098L21.3639 16.591L23.8799 22.5931H18.8457L17 27H19.2723L20.1929 24.8H24.8027L25.7234 27H28L23.3858 16V16.0023Z" fill="#F5F5F5"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M33.908 16.1412H31.8028V14H36V29H31.8028V26.8587H33.908V16.1412ZM11.0942 16.1412H13.1972V14H9V29H13.1972V26.8587H11.0942V16.1412Z" fill="#F5F5F5"/>
			</svg>`;
    marker.className = "default-map-marker";

    return marker;
  }

  createMap(center = [37.617635, 55.755814] as LngLat, zoom = 15) {
    this.ymap = new ymaps3.YMap(
      this.container,
      {
        location: {
          center,
          zoom,
        },
      },
      [
        new ymaps3.YMapDefaultSchemeLayer({}),
        new ymaps3.YMapDefaultFeaturesLayer({ zIndex: 1800 }),
      ]
    );
  }

  setLocation(center: LngLat, zoom = 15) {
    if (!this.ymap) return;

    this.ymap?.setLocation({
      center,
      zoom,
    });
  }

  async addDefaultMarker(coordinates: LngLat) {
    const { YMapDefaultMarker } = await ymaps3.import(
      "@yandex/ymaps3-markers@0.0.1"
    );
    this.ymap?.addChild(
      new YMapDefaultMarker({
        coordinates,
      })
    );
  }

  addMarker(
    coordinates: LngLat,
    content: HTMLElement,
    props?: Partial<YMapMarkerProps>
  ) {
    if (!this.ymap) return;

    const marker = new ymaps3.YMapMarker(
      {
        coordinates,
        draggable: false,
        ...props,
      },
      content
    );

    this.ymap.addChild(marker);
  }

  addMarkers(coordinates: LngLat[], content: (coords: LngLat) => HTMLElement) {
    coordinates.forEach((coords) => {
      this.addMarker(coords, content(coords));
    });
  }
}
