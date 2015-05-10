<?php

$mediaFrequencia = false;
$mediaAmplitude = false;
$dpFrequencia = false;
$dpAmplitude = false;

$palavras_chaves = "Suave;Forte;Exótico;Brasileiro;Colombiano;Etiopia;Preto;Escuro;Chocolate;Baunilha;Expresso;Delicioso;Experiência;Gastronomia;Poderoso;Aroma";

function calculateWavInformation($file_path)
{
	global $mediaFrequencia, $mediaAmplitude, $dpFrequencia, $dpAmplitude;

    chdir("/var/www/html");
    unlink("temp.wav");
	$cmd = "octave --no-gui --quiet processaAudio.m ";
	$resultado = exec($cmd . $file_path, $output, $status);

	$resultado = trim($resultado);

	while (strpos($resultado, "  ") !== false)
	{
		$resultado = str_replace("  ", " ", $resultado);
	}

	$array_resultado = explode(" ", $resultado);

	$mediaFrequencia = (float) $array_resultado[0];
	$mediaAmplitude = (float) $array_resultado[1];
	$dpFrequencia = (float) $array_resultado[2];
	$dpAmplitude = (float) $array_resultado[3];
}

function calculaNotaMediaFrequencia($sex)
{
	global $mediaFrequencia;
	
	$nota = 0;
	
	if ($sex == "male")
	{
		$nota = ($mediaFrequencia > 385.0 ? $mediaFrequencia - 385 : 385 - $mediaFrequencia) / 300;	
		$nota = (1 - $nota) * 100;
	}
	else
	{
		$nota = ($mediaFrequencia > 470.0 ? $mediaFrequencia - 470 : 470 - $mediaFrequencia) / 300;	
		$nota = (1 - $nota) * 100;
	}
	
	return $nota <= 0 ? 0 : (int) $nota;
}

function calculaNotaMediaAmplitude($sex)
{
	global $mediaAmplitude;
	
	$nota = 0;
	
	if ($sex == "male")
	{
		$nota = ($mediaAmplitude > 65.0 ? $mediaAmplitude - 65 : 65 - $mediaAmplitude) / 140;	
		$nota = (1 - $nota) * 100;
	}
	else
	{
		$nota = ($mediaAmplitude > 60.0 ? $mediaAmplitude - 60 : 60 - $mediaAmplitude) / 140;	
		$nota = (1 - $nota) * 100;
	}
	
	return $nota <= 0 ? 0 : (int) $nota;
}

function calculaNotaDesvioFrequencia($sex)
{
	global $dpFrequencia;
	
	$nota = 0;
	
	if ($sex == "male")
	{
		$nota = ($dpFrequencia > 9500.0 ? $dpFrequencia - 9500 : 9500 - $dpFrequencia) / 7000;	
		$nota = (1 - $nota) * 100;
	}
	else
	{
		$nota = ($dpFrequencia > 10000.0 ? $dpFrequencia - 10000 : 10000 - $dpFrequencia) / 7000;	
		$nota = (1 - $nota) * 100;
	}
	
	return $nota <= 0 ? 0 : (int) $nota;
}

function calculaNotaDesvioAmplitude($sex)
{
	global $dpAmplitude;
	
	$nota = 0;
	
	if ($sex == "male")
	{
		$nota = ($dpAmplitude > 30.0 ? $dpAmplitude - 30 : 30 - $dpAmplitude) / 100;	
		$nota = (1 - $nota) * 100;
	}
	else
	{
		$nota = ($dpAmplitude > 30.0 ? $dpAmplitude - 30 : 30 - $dpAmplitude) / 100;	
		$nota = (1 - $nota) * 100;
	}
	
	return $nota <= 0 ? 0 : (int) $nota;
}

function calculaNotaPalavras($linha)
{
	global $palavras_chaves;
	
	$array_chaves = explode(";", $palavras_chaves);
	$contador = 0;
	
	foreach ($array_chaves as $palavra)
	{
		if (strpos(strtolower($linha), strtolower($palavra)) !== false)
		{
			$contador += 1;
		}
	}
	
	
	$nota = $contador > 5 ? 100 : (int) ($contador / 5 * 100);
	
	return (int) $nota;
}

function calculaNotaFinal($sex, $linha)
{
	global $mediaFrequencia, $mediaAmplitude, $dpFrequencia, $dpAmplitude, $palavras_chaves;

	if ($sex == "invalid" || $linha == "invalid")
	{
		return "Você não fez o teste...";
	}

	$mf = calculaNotaMediaFrequencia($sex);
	$ma = calculaNotaMediaAmplitude($sex);
	$df = calculaNotaDesvioFrequencia($sex);
	$da = calculaNotaDesvioAmplitude($sex);
	$p = calculaNotaPalavras($linha);
	
	$resultado = (int)((5 * $mf + 3 * $ma + 1 * $da + 5 * $p) / 14);
	
	$str_saida = "<table>";
	$str_saida .= "<tr><td>Tom de Voz</td><td>" . $mf . "</td></tr>";
	$str_saida .= "<tr><td>Potência da Voz</td><td>" . $ma . "</td></tr>";
	$str_saida .= "<tr><td>Monotonia</td><td>" . $da . "</td></tr>";
	$str_saida .= "<tr><td>Palavras Importantes</td><td>" . $p . "</td></tr>";
	$str_saida .= "<tr><td>Total</td><td>" . $resultado . "</td></tr>";
	$str_saida .= "</table>";
	
	return $str_saida;
}

function moveUploadedFile()
{
	$type = $_FILES["myfile"]["type"];
	$size = $_FILES["myfile"]["size"];
	$result = false;
	
	if(($type == "audio/wav" || $type == "audio/x-wav") && $size < 20000000) 
	{
		if(move_uploaded_file($_FILES['myfile']['tmp_name'], "temp.wav")) 
		{
			$result = true;
		}
	}
	
	return $result;
}

?>
