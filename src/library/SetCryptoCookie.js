import Cookies from "js-cookie";
import CryptoJS from "crypto-js";

const SECRET_KEY = "U2FsdGVkX196hp4EfKBtbvKnMpzlHZ5cyWeyYiS0P64Pateron2020";

const setEncryptCookie = (cookieName, data) => {
  // console.log(cookieName, data);
  if (typeof data === "object") {
    let encryptdata = CryptoJS.AES.encrypt(
      JSON.stringify(data).toString(),
      SECRET_KEY
    ).toString();
    console.log("SUKSES ENCRYPT");
    return Cookies.set(cookieName, encryptdata);
  } else {
    console.log("SUKSES ENCRYPT");
    return Cookies.set(
      cookieName,
      CryptoJS.AES.encrypt(data.toString(), SECRET_KEY).toString()
    );
  }
};

const setDecryptCookie = (cookieName, type) => {
  let checkData = Cookies.get(cookieName) || false;

  let result = "";

  console.log(checkData);
  if (checkData !== false) {
    checkData = Cookies.get(cookieName);
    if (type === "object") {
      console.log(checkData);
      let decryptData = CryptoJS.AES.decrypt(checkData, SECRET_KEY);
      result = JSON.parse(decryptData.toString(CryptoJS.enc.Utf8));
    } else {
      console.log(checkData);
      let decryptData = CryptoJS.AES.decrypt(checkData, SECRET_KEY);
      result = decryptData.toString(CryptoJS.enc.Utf8);
    }
  } else {
    result = [];
  }
  return result;
};

export { setEncryptCookie, setDecryptCookie };
