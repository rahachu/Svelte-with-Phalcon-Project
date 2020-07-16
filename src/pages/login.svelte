<script>
    import {get,post} from "../library/csrfFetch.js"
    import { goto } from "@sveltech/routify"

    let userInfo = get("/auth").then(res=>res.json())
    .then(data=>{
        if (data.login) {
            $goto('/');
        }
    })

    let promise = null;
    let loginInfo = {
        login : '',
        password : '',
    };
    async function login() {
        let auth = await post("/login",loginInfo);
        let authInfo = await auth.json();

        if (auth.ok) {
            $goto('/');
        }
        else {
            throw new Error(authInfo.error);
        }
    }

    function handleClick() {
        promise = login();
    }
</script>

{#await userInfo}
    <p>loading</p>
{:then res}
<input bind:value={loginInfo.login} placeholder="enter your name">
<input bind:value={loginInfo.password} type="password" placeholder="enter your password">
<button on:click={handleClick}>
	login
</button>
{/await}

{#await promise}
	<p>...waiting</p>
{:then number}
	<p>The number is {loginInfo.user}</p>
{:catch error}
	<p style="color: red">{error}</p>
{/await}