function calculateEER() {
  // Pegue as variáveis do formulário
  const age = parseFloat(document.getElementById("age").value);
  const heightInCm = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("postWeight").value); // Peso pós-gestação agora
  const weeks = parseFloat(document.getElementById("weeks").value);
  const activityLevel = document.getElementById("activityLevel").value;

  let EER = 0;

  // Calcula o EER com base no nível de atividade
  switch (activityLevel) {
    case 'Sedentária':
      EER = 1131.20 - (2.04 * age) + (0.34 * heightInCm) + (12.15 * weight) + (9.16 * weeks);
      break;
    case 'Pouco Ativa':
      EER = 693.35 - (2.04 * age) + (5.73 * heightInCm) + (10.20 * weight) + (9.16 * weeks);
      break;
    case 'Ativa':
      EER = 223.84 - (2.04 * age) + (13.23 * heightInCm) + (8.15 * weight) + (9.16 * weeks);
      break;
    case 'Muito Ativa':
      EER = 779.72 - (2.04 * age) + (18.45 * heightInCm) + (8.73 * weight) + (9.16 * weeks);
      break;
  }

  // Atualize o resultado na página
  document.getElementById("result").innerText = `O EER estimado é ${EER.toFixed(2)} kcal/dia.`;
}

function calculateBMI() {
  // Pegue as variáveis do formulário
  const preWeight = parseFloat(document.getElementById("preWeight").value);
  const heightInM = parseFloat(document.getElementById("heightM").value);  // Já em metros


  // Verifique se os valores são números válidos
  if (isNaN(preWeight) || isNaN(heightInM)) {
    alert("Por favor, insira números válidos");
    return;
  }

  // Calcule o IMC
  const BMI = preWeight / (heightInM * heightInM);

  // Atualize o resultado na página
  document.getElementById("bmi-result").innerText = `Seu IMC é ${BMI.toFixed(2)}`;
}

function calculateNutrientRequirements() {
  // Pegue as variáveis do formulário
  const age = parseFloat(document.getElementById("age").value);
  const heightInCm = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("weight").value);
  const activityLevel = document.getElementById("activityLevel").value;

  let nutrientRequirements = 0;

  // Calcula os requisitos de nutrientes com base no nível de atividade
  switch (activityLevel) {
    case 'Sedentária':
      nutrientRequirements = 584.90 - (7.01 * age) + (5.72 * heightInCm) + (11.71 * weight);
      break;
    case 'Pouco Ativa':
      nutrientRequirements = 575.77 - (7.01 * age) + (6.60 * heightInCm) + (12.14 * weight);
      break;
    case 'Ativa':
      nutrientRequirements = 710.25 - (7.01 * age) + (6.54 * heightInCm) + (12.34 * weight);
      break;
    case 'Muito Ativa':
      nutrientRequirements = 511.83 - (7.01 * age) + (9.07 * heightInCm) + (12.53 * weight);
      break;
  }

  // Atualize o resultado na página
  document.getElementById("result").innerText = `A quantidade de nutrientes necessária é ${nutrientRequirements.toFixed(2)} unidades/dia.`;
}

