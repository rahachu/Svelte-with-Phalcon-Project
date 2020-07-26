<script>
	import Cookies from 'js-cookie';
  import { goto } from '@sveltech/routify'

	$:data 	= '';
	// let today = new Date();
	// 	let bulan 	= today.toLocaleString('default', { month: 'short' });
	// 	let tanggal = today.getDate()
	// 	let tahun 	= today.getFullYear()
	// 	let jam 		= today.getHours()+2
	// 	let menit 	= today.getMinutes()
	// 	let detik 	= today.getSeconds()

	let countDown = new Date(`${getCookie("TRYOUTTIME")}`);
	
	let startTime = setInterval(function(){
		let now = new Date().getTime()
		let distance = countDown - now;
		
		let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		let seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
		data = `${hours}Jam : ${minutes}Menit : ${seconds}s`;
			
		if (distance < 0) {
			clearInterval(startTime);
			data = "WAKTU HABIS"
			$goto('/tryout');
		}
	}, 1000)

		
	function getCookie(name){
		let resultCookie = Cookies.get(name)
		let decryptCookie = atob(resultCookie);

		return decryptCookie;
	} 
</script>
<p>{data}</p>