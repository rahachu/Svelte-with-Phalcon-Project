async function post(uri, data) {
  let csrf = document.getElementById("csrf");
  let formdata = new FormData();
  formdata.append(csrf.name, csrf.value);
  for (const key in data) {
    if (data.hasOwnProperty(key)) {
      const element = data[key];
      formdata.append(key, element);
    }
  }
  let promise = await fetch(uri, {
    method: "POST",
    body: formdata,
  });
  let res = await promise.clone().json();
  csrf.name = res.csrfKey;
  csrf.value = res.csrfToken;
  return promise;
}

function get(uri) {
  return fetch(uri, {
    method: "GET",
  });
}

export { post, get };
