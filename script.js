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
