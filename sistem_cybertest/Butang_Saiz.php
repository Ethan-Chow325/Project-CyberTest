<br>

<!-- Change Text Size (Function) -->
<script>
	function resizeText(multiplier)
	{
		var element = document.getElementById('besar');
		var currentSize = element.style.fontSize || 1;
		if (multiplier==2)
		{
			element.style.fontSize = "1em";
		}
		else
		{
			element.style.fontSize = (parseFloat(currentSize) + (multiplier * 0.2)) + "em";
		}
	}
</script>

<!-- Font Size Button -->
<div class="w3-margin-bottom">
	<div class="w3-xlarge w3-text-aqua" style="text-shadow: 3px 3px #555">
		<i class="fa fa-exclamation-triangle" aria-hidden="true"><b> Text Size Quantifier: </b></i>
	</div>
	
	<input class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" name='reSize1' type='button' value='RESET' onclick="resizeText(2)" />
	<input class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" name='reSize'  type='button' value='&nbsp; + &nbsp;'	onclick="resizeText(1)" />
	<input class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" name='reSize2' type='button' value='&nbsp; - &nbsp;' 	onclick="resizeText(-1)" />
</div>