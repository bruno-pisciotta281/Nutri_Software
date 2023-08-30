function calculateEER() {
    const age = parseInt(document.getElementById("age").value);
    const preWeight = parseFloat(document.getElementById("preWeight").value);
    const postWeight = parseFloat(document.getElementById("postWeight").value);
    const height = parseFloat(document.getElementById("height").value);
    const weeks = parseInt(document.getElementById("weeks").value);
    const activityLevel = document.getElementById("activityLevel").value;
  
    const PA = getActivityLevelMultiplier(activityLevel);
    const preEER = 354 - (6.91 * age) + PA * (10 * preWeight) + (934 * height) + 25;
    const EER = preEER + (8 * weeks) + 180;
  
    document.getElementById("result").innerText = `O EER estimado é de ${EER.toFixed(2)} kcal/dia`;
  }
  
  function getActivityLevelMultiplier(level) {
    switch (level) {
      case 'Sedentária':
        return 1.0;
      case 'Pouco Ativa':
        return 1.1;
      case 'Ativa':
        return 1.2;
      case 'Muito Ativa':
        return 1.3;
      default:
        return 1;
    }
  }
  