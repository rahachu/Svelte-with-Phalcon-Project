const convertRp = (val) => {
  return val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
};

export default convertRp;
