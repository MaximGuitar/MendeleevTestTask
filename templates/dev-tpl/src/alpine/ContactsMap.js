import Map from "../libs/Map";

export default (coordinates = "", zoom = 12) => ({
  async init() {
    await Map.loadAPI();
    const coords = coordinates.split(",", 2).map((value) => parseFloat(value));

    const map = new Map({
      container: this.$root,
      center: [coords[1], coords[0]],
      zoom,
    });
    map.addDefaultMarker([coords[1], coords[0]]);
  },
});
