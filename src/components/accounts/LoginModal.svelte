<script>
  export let activateModal;
  import { quintOut } from "svelte/easing";
  import { fade, fly, slide } from "svelte/transition";
  import { get, post } from "../../library/csrfFetch.js";
  import { goto } from "@sveltech/routify";
  import { auth } from "../../store/auth.js";

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
  .login-modal {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .error {
    color: red;
    text-align: left;
  }

  .login-modal__form {
    background-color: #fff;
    width: 400px;
    padding: 10px;
    position: absolute;
    z-index: 5;
    border-radius: 10px;
  }

  .login-modal__form__header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: -20px;
  }

  #close {
    cursor: pointer;
  }

  .main-form {
    padding: 20px;
    margin-top: -20px;
    display: flex;
    flex-direction: column;
  }

  .input-login {
    background: rgba(253, 125, 0, 0.1);
    border-radius: 10px;
    border: 1px solid blue;
  }

  .buttons {
    padding-bottom: 20px;
    padding-top: 30px;
  }

  .btn-masuk {
    background-color: var(--blue-color);
    width: 200px;
    text-align: center;
    margin-top: 20px;
    color: #fff;
    border-radius: 10px;
    margin: 0 auto;
  }
</style>

<div
  class="login-modal"
  transition:fly={{ delay: 200, duration: 800, y: 50, easing: quintOut }}>
  <div class="login-modal__form">
    <div class="login-modal__form__header">
      <div class="has-text-weight-semibold is-size-5">Masuk</div>
      <div id="close" on:click={activateModal}>X</div>
    </div>
    <hr />
    <form on:submit|preventDefault={loginProcess} class="main-form">
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
