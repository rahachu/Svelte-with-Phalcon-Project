<script>
    let promise = login();
    let loginInfo = {
        user : '',
        password : '',
    };
    async function login() {
        let auth = await fetch('/auth');
        let authInfo = await auth.json();

        if (auth.ok) {
            return authInfo;
        }
        else {
            throw new Error(authInfo);
        }
    }

    function handleClick() {
        promise = login();
    }
</script>

<input bind:value={loginInfo.user} placeholder="enter your name">
<button on:click={handleClick}>
	login
</button>

{#await promise}
	<p>...waiting</p>
{:then number}
	<p>The number is {loginInfo.user}</p>
{:catch error}
	<p style="color: red">Gagal</p>
{/await}