<script>
	let userInfo = auth()
	async function auth() {
		let getReq = await fetch('/auth');
		let res = getReq.json()
		if (getReq.ok) {
			return res;
		}
		else{
			throw new Error(res);
		}
	}
	function handleClick() {
		userInfo = fetch('/logout');
	}
</script>

{#await userInfo}
<p>loading...</p>
{:then res}
<h1>Hello {res.username}!</h1>
<p>Visit the <a href="/accounts/login">Login</a> to learn how to build Svelte apps. <a href="/" on:click={handleClick}>logout</a></p>
{:catch error}
{error}
{/await}

<style>

	h1 {
		color: #ff3e00;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
	}
</style>