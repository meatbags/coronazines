/** Scale child rect to fit inside parent, preserving ratio */

const GetContainedRect = (child, parent) => {
  const childRatio = child.width / child.height;
  const parentRatio = parent.width / parent.height;
  const portrait = childRatio < parentRatio;
  const w = portrait ? parent.height * childRatio : parent.width;
  const h = portrait ? parent.height : parent.width / childRatio;
  return {width: w, height: h};
};

export default GetContainedRect;
