<body>
	<style>
		label{
			display: inline-block;
			width: 150px;
		}
		input{
			width: 250px;
			display: block;
			margin-bottom: 5px;
		}
	</style>
	<?php if(Yii::app()->session['FINANCIAL_YEAR'] == 1){ ?>
	<label>Income Tax (103%)<input type="text" id="itval" onkeyup="calculate();" class="form-control"></label><br>
	<label>IT (100%)<input type="text" id="taxcomp" class="form-control"></label><br>
	<label>ECESS (2%)<input type="text" id="ecess" class="form-control"></label><br>
	<label>HCESS (1%)<input type="text" id="hcess" class="form-control"></label><br>
	<label>Total (103%)<input type="text" id="total" class="form-control"></label><br>
	<script>
		window.onload = function(){
		};
		function calculate(){
			var itval = document.getElementById('itval'),
				taxcomp = document.getElementById('taxcomp'),
				ecess = document.getElementById('ecess'),
				hcess = document.getElementById('hcess'),
				totalField = document.getElementById('total');
			
			taxcomp.value = Math.round((itval.value * 100)/103);
			ecess.value = Math.round((itval.value * 2)/103);
			hcess.value = Math.round((itval.value * 1)/103);
			var total = parseInt(taxcomp.value) + parseInt(ecess.value) + parseInt(hcess.value);
			totalField.value = total;
			totalField.style.background = (total == itval.value)? '#0F0' : '#F00';
		}
	</script>
	<?php } else { ?>
	<label>Income Tax (104%)<input type="text" id="itval" onkeyup="calculate();" class="form-control"></label><br>
	<label>IT (100%)<input type="text" id="taxcomp" class="form-control"></label><br>
	<label>ECESS (2%)<input type="text" id="ecess" class="form-control"></label><br>
	<label>HCESS (2%)<input type="text" id="hcess" class="form-control"></label><br>
	<label>Total (104%)<input type="text" id="total" class="form-control"></label><br>
	<script>
		window.onload = function(){
		};
		function calculate(){
			var itval = document.getElementById('itval'),
				taxcomp = document.getElementById('taxcomp'),
				ecess = document.getElementById('ecess'),
				hcess = document.getElementById('hcess'),
				totalField = document.getElementById('total');
			
			taxcomp.value = Math.round((itval.value * 100)/104);
			ecess.value = Math.round((itval.value * 2)/104);
			hcess.value = Math.round((itval.value * 2)/104);
			var total = parseInt(taxcomp.value) + parseInt(ecess.value) + parseInt(hcess.value);
			totalField.value = total;
			totalField.style.background = (total == itval.value)? '#0F0' : '#F00';
		}
	</script>
	<?php }?>
</body>