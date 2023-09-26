function calculateEER() {
  // Pegue as variáveis do formulário
  const age = parseFloat(document.getElementById("age").value);
  const heightInCm = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("postWeight").value); // Peso pós-gestação agora
  const weeks = parseFloat(document.getElementById("weeks").value);
  const activityLevel = document.getElementById("activityLevel").value;

  let EER = 0;

  // Calcula o GET com base no nível de atividade
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
  document.getElementById("result").innerText = `O GET estimado é ${EER.toFixed(2)} kcal/dia.`;
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
  document.getElementById("bmi-result").innerText = `Seu IMC é ${BMI.toFixed(2)} kg/m²`;
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
  document.getElementById("result").innerText = `A quantidade de nutrientes necessária é ${nutrientRequirements.toFixed(2)} kcal/dia.`;
}

 // Função para mostrar a resolução do cálculo de GET em um modal
function showResolution() {
  // Pegue as variáveis do formulário
  const age = parseFloat(document.getElementById("age").value);
  const heightInCm = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("postWeight").value); // Peso pós-gestação agora
  const weeks = parseFloat(document.getElementById("weeks").value);
  const activityLevel = document.getElementById("activityLevel").value;

// Verifique se todos os campos foram preenchidos
if (isNaN(age) || isNaN(heightInCm) || isNaN(weight) || isNaN(weeks) || isNaN(activityLevel) ) {
  alert("Preencha todos os campos e gere um resultado para verificar a Resolução.");
  return; // Não continue se algum campo estiver vazio ou não numérico
}


  let EER = 0;
  let explanation = ""; // Inicialize a explicação vazia

  // Calcula o GET com base no nível de atividade e crie a explicação
  switch (activityLevel) {
    case 'Sedentária':
      EER = 1131.20 - (2.04 * age) + (0.34 * heightInCm) + (12.15 * weight) + (9.16 * weeks);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Sedentária'</strong> é:<br><br>
        <strong>EER =</strong> 1131.20 - (2.04 * idade) + (0.34 * altura em cm) + (12.15 * peso) + (9.16 * semanas de gestação).<br><br>
        <strong>EER =</strong> 1131.20 - (2.04 * ${age}) + (0.34 * ${heightInCm}) + (12.15 * ${weight}) + (9.16 * ${weeks}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
      `;
      break;
    case 'Pouco Ativa':
      EER = 693.35 - (2.04 * age) + (5.73 * heightInCm) + (10.20 * weight) + (9.16 * weeks);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Pouco Ativa'</strong> é:<br><br>
        <strong>EER =</strong> 693.35 - (2.04 * idade) + (5.73 * altura em cm) + (10.20 * peso) + (9.16 * semanas de gestação).<br><br>
        <strong>EER =</strong> 693.35 - (2.04 * ${age}) + (5.73 * ${heightInCm}) + (10.20 * ${weight}) + (9.16 * ${weeks}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
      `;
      break;
    case 'Ativa':
      EER = 223.84 - (2.04 * age) + (13.23 * heightInCm) + (8.15 * weight) + (9.16 * weeks);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Ativa'</strong> é:<br><br>
        <strong>EER =</strong> 223.84 - (2.04 * idade) + (13.23 * altura em cm) + (8.15 * peso) + (9.16 * semanas de gestação).<br><br>
        <strong>EER =</strong> 223.84 - (2.04 * ${age}) + (13.23 * ${heightInCm}) + (8.15 * ${weight}) + (9.16 * ${weeks}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
      `;
      break;
    case 'Muito Ativa':
      EER = 779.72 - (2.04 * age) + (18.45 * heightInCm) + (8.73 * weight) + (9.16 * weeks);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Muito Ativa'</strong> é:<br><br>
        <strong>EER =</strong> 779.72 - (2.04 * idade) + (18.45 * altura em cm) + (8.73 * peso) + (9.16 * semanas de gestação).<br><br>
        <strong>EER =</strong> 779.72 - (2.04 * ${age}) + (18.45 * ${heightInCm}) + (8.73 * ${weight}) + (9.16 * ${weeks}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia. </strong>
      `;
      break;
  }

  // Preencha o conteúdo do modal com a resolução e explicação
  const resolutionContent = document.getElementById("resolutionContent");
  resolutionContent.innerHTML = `
    <p><strong>GET estimado:</strong> ${EER.toFixed(2)} kcal/dia</p>
  `;

  // Preencha a explicação no modal
  const explanationElement = document.getElementById("explanation");
  explanationElement.innerHTML = explanation;

  // Exiba o modal com a resolução
  const modal = document.getElementById("resolutionModal");
  modal.style.display = "block";
}

// Função para mostrar a resolução do cálculo de GET para Lactantes em um modal
function showResolutionForLactantes() { 
  // Pegue as variáveis do formulário
  const age = parseFloat(document.getElementById("age").value);
  const heightInCm = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("weight").value);
  const activityLevel = document.getElementById("activityLevel").value;

  // Verifique se todos os campos foram preenchidos
  if (isNaN(age) || isNaN(heightInCm) || isNaN(weight) || isNaN(activityLevel) ) {
    alert("Preencha todos os campos e gere um resultado para verificar a Resolução.");
    return; // Não continue se algum campo estiver vazio ou não numérico
  }


  let EER = 0;
  let explanation = ""; // Inicialize a explicação vazia

  // Calcula o GET com base no nível de atividade e crie a explicação
  switch (activityLevel) {
    case 'Sedentária':
      EER = 584.90 - (7.01 * age) + (5.72 * heightInCm) + (11.71 * weight);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Sedentária'</strong> é:<br><br>
        <strong>EER =</strong> 584.90 - (7.01 * idade) + (5.72 * altura em cm) + (11.71 * peso).<br><br>
        <strong>EER =</strong> 584.90 - (7.01 * ${age}) + (5.72 * ${heightInCm}) + (11.71 * ${weight}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
      `;
      break;
    case 'Pouco Ativa':
      EER = 575.77 - (7.01 * age) + (6.60 * heightInCm) + (12.14 * weight);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Pouco Ativa'</strong> é:<br><br>
        <strong>EER =</strong> 575.77 - (7.01 * idade) + (6.60 * altura em cm) + (12.14 * peso).<br><br>
        <strong>EER =</strong> 575.77 - (7.01 * ${age}) + (6.60 * ${heightInCm}) + (12.14 * ${weight}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
      `;
      break;
    case 'Ativa':
      EER = 710.25 - (7.01 * age) + (6.54 * heightInCm) + (12.34 * weight);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Ativa'</strong> é:<br><br>
        <strong>EER =</strong> 710.25 - (7.01 * idade) + (6.54 * altura em cm) + (12.34 * peso).<br><br>
        <strong>EER =</strong> 710.25 - (7.01 * ${age}) + (6.54 * ${heightInCm}) + (12.34 * ${weight}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
      `;
      break;
    case 'Muito Ativa':
      EER = 511.83 - (7.01 * age) + (9.07 * heightInCm) + (12.53 * weight);
      explanation = `
        A fórmula utilizada para calcular o GET no nível <strong>'Muito Ativa'</strong> é:<br><br>
        <strong>EER =</strong> 511.83 - (7.01 * idade) + (9.07 * altura em cm) + (12.53 * peso).<br><br>
        <strong>EER =</strong> 511.83 - (7.01 * ${age}) + (9.07 * ${heightInCm}) + (12.53 * ${weight}).<br><br>
        <strong>EER = ${EER.toFixed(2)} kcal/dia. </strong>
      `;
      break;
  }

  // Preencha o conteúdo do modal com a resolução e explicação
  const resolutionContent = document.getElementById("resolutionContent");
  resolutionContent.innerHTML = `
    <p><strong>GET estimado:</strong> ${EER.toFixed(2)} kcal/dia</p>
  `;

  // Preencha a explicação no modal
  const explanationElement = document.getElementById("explanation");
  explanationElement.innerHTML = explanation;

  // Exiba o modal com a resolução
  const modal = document.getElementById("resolutionModalLactantes");
  modal.style.display = "block";
}

function calculateEERForLactentes() {
  // Pegue as variáveis do formulário
  const sex = document.querySelector('input[name="sex"]:checked');
  const ageInMonths = parseFloat(document.getElementById("age").value);
  const heightInCm = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("weight").value);

  // Converta a idade de meses para anos
  const ageInYears = ageInMonths / 12;

  let EER = 0;

  // Verifique se o sexo foi selecionado
  if (sex) {
    // Aplica a fórmula com base no sexo e idade em anos
    if (sex.value === 'menino') {
      if (ageInMonths <= 3) {
        EER = -716.45 - (1 * ageInYears) + (17.82 * heightInCm) + (15.06 * weight) + 200;
      } else if (ageInMonths <= 6) {
        EER = -716.45 - (1 * ageInYears) + (17.82 * heightInCm) + (15.06 * weight) + 50;
      } else if (ageInMonths <= 12) {
        EER = -716.45 - (1 * ageInYears) + (17.82 * heightInCm) + (15.06 * weight) + 20;
      }
    } else if (sex.value === 'menina') {
      if (ageInMonths <= 3) {
        EER = -69.15 - (80 * ageInYears) + (2.65 * heightInCm) + (57.15 * weight) + 180;
      } else if (ageInMonths <= 6) {
        EER = -69.15 - (80 * ageInYears) + (2.65 * heightInCm) + (57.15 * weight) + 60;
      } else if (ageInMonths <= 12) {
        EER = -69.15 - (80 * ageInYears) + (2.65 * heightInCm) + (57.15 * weight) + 20;
      }
    }
  }

  // Verifique se o resultado é negativo e, se for, defina como zero
  if (EER < 0) {
    EER = 0;
  }

  // Atualize o resultado na página
  document.getElementById("result").innerText = `O GET estimado é ${EER.toFixed(2)} kcal/dia.`;
}

function showSolutionForLactentes() {
  // Pegue as variáveis do formulário
  const sex = document.querySelector('input[name="sex"]:checked');
  const ageInMonths = parseFloat(document.getElementById("age").value);
  const heightInCm = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("weight").value);

   // Verifique se todos os campos foram preenchidos
   if (!sex || isNaN(ageInMonths) || isNaN(heightInCm) || isNaN(weight)) {
    alert("Preencha todos os campos e gere um resultado para verificar a Resolução.");
    return; // Não continue se algum campo estiver vazio ou não numérico
  }

  // Converta a idade de meses para anos
  const ageInYears = ageInMonths / 12;

  let EER = 0;
  let explanation = ""; // Inicialize a explicação vazia

  // Verifique se o sexo foi selecionado
  if (sex) {
    // Aplica a fórmula com base no sexo e idade em anos
    if (sex.value === 'menino') {
      if (ageInMonths <= 3) {
        EER = -716.45 - (1 * ageInYears) + (17.82 * heightInCm) + (15.06 * weight) + 200;
        explanation = `
          A fórmula utilizada para calcular o GET para lactentes <strong>meninos</strong> com idade até<strong>3 meses</strong> é:<br><br>
          <strong>EER =</strong> -716.45 - (1 * idade em anos) + (17.82 * altura em cm) + (15.06 * peso) + 200.<br><br>
          <strong>EER =</strong> -716.45 - (1 * ${ageInYears}) + (17.82 * ${heightInCm}) + (15.06 * ${weight}) + 200.<br><br>
          <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
        `;
      } else if (ageInMonths <= 6) {
        EER = -716.45 - (1 * ageInYears) + (17.82 * heightInCm) + (15.06 * weight) + 50;
        explanation = `
          A fórmula utilizada para calcular o GET para lactentes <strong>meninos</strong> com idade entre <strong>3 e 6 meses</strong> é:<br><br>
          <strong>EER =</strong> -716.45 - (1 * idade em anos) + (17.82 * altura em cm) + (15.06 * peso) + 50.<br><br>
          <strong>EER =</strong> -716.45 - (1 * ${ageInYears}) + (17.82 * ${heightInCm}) + (15.06 * ${weight}) + 50.<br><br>
          <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
        `;
      } else if (ageInMonths <= 12) {
        EER = -716.45 - (1 * ageInYears) + (17.82 * heightInCm) + (15.06 * weight) + 20;
        explanation = `
          A fórmula utilizada para calcular o GET para lactentes <strong>meninos</strong> com idade entre <strong>6 e 12 meses</strong> é:<br><br>
          <strong>EER =</strong> -716.45 - (1 * idade em anos) + (17.82 * altura em cm) + (15.06 * peso) + 20.<br><br>
          <strong>EER =</strong> -716.45 - (1 * ${ageInYears}) + (17.82 * ${heightInCm}) + (15.06 * ${weight}) + 20.<br><br>
          <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
        `;
      }
    } else if (sex.value === 'menina') {
      if (ageInMonths <= 3) {
        EER = -69.15 - (80 * ageInYears) + (2.65 * heightInCm) + (57.15 * weight) + 180;
        explanation = `
          A fórmula utilizada para calcular o GET para lactentes <strong>meninas</strong> com idade até <strong>3 meses</strong> é:<br><br>
          <strong>EER =</strong> -69.15 - (80 * idade em anos) + (2.65 * altura em cm) + (57.15 * peso) + 180.<br><br>
          <strong>EER =</strong> -69.15 - (80 * ${ageInYears}) + (2.65 * ${heightInCm}) + (57.15 * ${weight}) + 180.<br><br>
          <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
        `;
      } else if (ageInMonths <= 6) {
        EER = -69.15 - (80 * ageInYears) + (2.65 * heightInCm) + (57.15 * weight) + 60;
        explanation = `
          A fórmula utilizada para calcular o GET para lactentes <strong>meninas</strong> com idade entre <strong>3 e 6 meses</strong> é:<br><br>
          <strong>EER =</strong> -69.15 - (80 * idade em anos) + (2.65 * altura em cm) + (57.15 * peso) + 60.<br><br>
          <strong>EER =</strong> -69.15 - (80 * ${ageInYears}) + (2.65 * ${heightInCm}) + (57.15 * ${weight}) + 60.<br><br>
          <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
        `;
      } else if (ageInMonths <= 12) {
        EER = -69.15 - (80 * ageInYears) + (2.65 * heightInCm) + (57.15 * weight) + 20;
        explanation = `
          A fórmula utilizada para calcular o GET para lactentes <strong>meninas</strong> com idade entre <strong>6 e 12 meses</strong> é:<br><br>
          <strong>EER =</strong> -69.15 - (80 * idade em anos) + (2.65 * altura em cm) + (57.15 * peso) + 20.<br><br>
          <strong>EER =</strong> -69.15 - (80 * ${ageInYears}) + (2.65 * ${heightInCm}) + (57.15 * ${weight}) + 20.<br><br>
          <strong>EER = ${EER.toFixed(2)} kcal/dia.</strong>
        `;
      }
    }
  }

  // Verifique se o resultado é negativo e, se for, defina como zero
  if (EER < 0) {
    EER = 0;
  }

  // Atualize o resultado na página
  document.getElementById("result").innerText = `O GET estimado é ${EER.toFixed(2)} kcal/dia.`;

  // Atualize o conteúdo da explicação na página
  const explanationElement = document.getElementById("explanation");
  explanationElement.innerHTML = explanation;

  // Exiba o modal de solução
  const modal = document.getElementById("solutionModal");
  modal.style.display = "block";
}








