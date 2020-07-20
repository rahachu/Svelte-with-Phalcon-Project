<script>
	import {get,post} from "../../library/csrfFetch.js"
	import { goto } from "@sveltech/routify"

	// let userInfo = get("/auth").then(res=>res.json())
	// .then(data=>{
	// 	console.log(data)
	// })

	let userLogin = {
		login:'',
		password:''
	}

	let isLoading = false
	let isFieldNull = true
	let isError = {
		status:false,
		message:''
	}

	$:isFieldNull = userLogin.username === '' || userLogin.password === '' ? true : false;

	const loginProcess = async ()=>  {
		console.log(userLogin)
		try {
      let fetchLogin = await post("/login", userLogin);
			console.log(fetchLogin);

			// isLoading = false;
			
			// if(fetchLogin.status === 200){
			// 	$goto('/users/siswa/dashboard');	
			// }else{
			// 	isError.status = true;
			// 	isError.message = response.error;
			// }
		} catch (error) {
			console.log(error);
		}
	}

	const handleSubmit = (e) => {
		e.preventDefault();
		isLoading = true
		loginProcess();
	}
</script>

<style>
  .login{
    display: flex;
    justify-content: center;
    margin-top: 10%;
	}
	
	.error{
		color:red;
		text-align: left;
	}

	.form-group{
		text-align: left;
	}

	form input{
		width: 300px
	}
</style>
<div>
	<div class="login">

		<form on:submit={handleSubmit} method="POST">

			<div class="form-group">
				<label for="username">Username</label>
				<input bind:value={userLogin.login} type="text" autocomplete="off" placeholder="Masukan Username">
			</div>
			
			<div class="form-group">
				<label for="password">Password</label>
				<input bind:value={userLogin.password} type="password" autocomplete="off" placeholder="Masukan Password">
			</div>

			{#if isError.status}
				<h5 class="error">{isError.message}</h5>
			{/if}
	
			<button type="submit" disabled={isFieldNull}>
				{#if isLoading}
					Loading
				{:else}
					Login
				{/if}
			</button>
		
		</form>

	</div>

</div>