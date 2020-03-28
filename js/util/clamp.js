/** Clamp */

const Clamp = (val, min, max) => {
  return Math.min(max, Math.max(min, val));
};

export default Clamp;
