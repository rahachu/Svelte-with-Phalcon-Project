<script>
  import { get, post } from "../../library/csrfFetch.js";
  import { goto } from "@sveltech/routify";
  import { auth } from "../../store/auth.js";

  // let userInfo = get("/auth").then(res=>res.json())
  // .then(data=>{
  // 	console.log(data)
  // })

  let userLogin = {
    login: "",
    password: ""
  };

  let isLoading = false;
  let isFieldNull = true;
  let isError = {
    status: false,
    message: ""
  };

  $: isFieldNull =
    userLogin.username === "" || userLogin.password === "" ? true : false;

  async function loginProcess() {
    try {
      let fetchLogin = await post("/login", userLogin);
      let response = await fetchLogin.json();
      isLoading = false;

      if (fetchLogin.status === 200) {
        auth.set(response.userData);
        $goto(
          `/users/${
            response.userData.siswa.length == 0 ? "admin" : "siswa"
          }/dashboard`
        );
      } else {
        auth.refresh();
        isError.status = true;
        isError.message = response.error;
      }
    } catch (error) {
      auth.refresh();
      isError.status = true;
      isError.message = error;
    }
  }
</script>

<style>
  .login {
    display: flex;
    justify-content: center;
    margin-top: 100px;
  }

  .error {
    color: red;
    text-align: left;
  }

  .main-form {
    padding: 20px;
    margin-top: -20px;
    display: flex;
    flex-direction: column;
    box-shadow: 3px 3px 30px rgba(1, 49, 131, 0.15);
    border-radius: 10px;
  }

  .input-login {
    background: rgba(253, 125, 0, 0.1);
    border-radius: 10px;
    border: 1px solid blue;
  }

  .buttons {
    padding-bottom: 40px;
    padding-top: 10px;
  }

  .btn-masuk {
    background-color: var(--blue-color);
    width: 100%;
    text-align: center;
    margin-top: 20px;
    color: #fff;
    border-radius: 10px;
    margin: 0 auto;
  }

  form input {
    width: 350px;
  }

  h4 {
    color: var(--blue-color);
  }

  hr {
    margin-top: -20px;
  }
</style>

<div>
  <div class="login">
    <form on:submit|preventDefault={loginProcess} class="main-form">
      <h4 class="title is-5">Masuk untuk melanjutkan</h4>
      <hr />
      <div class="field">
        <div class="control">
          <label for="username">Username</label>
          <input
            bind:value={userLogin.login}
            class="input input-login"
            type="text"
            placeholder="Masukan nama pengguna" />
        </div>
      </div>
      <div class="field">
        <div class="control">
          <label for="password">Password</label>
          <input
            bind:value={userLogin.password}
            class="input input-login"
            type="password"
            placeholder="Masukan kata sandi" />
        </div>
      </div>
      <a href="/" id="main-form__lupa-password">lupa password</a>

      {#if isError.status}
        <h5 class="error">{isError.message}</h5>
      {/if}

      <div class="buttons">
        <button
          type="submit"
          class="button is-info btn-masuk"
          disabled={isFieldNull}>
          {#if isLoading}Loading{:else}Masuk{/if}
        </button>
      </div>
    </form>
  </div>
</div>
