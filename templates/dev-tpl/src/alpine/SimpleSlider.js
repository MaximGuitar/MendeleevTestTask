export default ({ speed = 900, spaceBetween = 0, autoHeight = false }) => ({
  async init() {
    const { default: Swiper } = await import("../libs/Swiper");
    new Swiper(this.$refs.swiper, {
      speed,
      spaceBetween,
      autoHeight,
      navigation: {
        prevEl: this.$refs.prev,
        nextEl: this.$refs.next,
      },
    });
  },
});
