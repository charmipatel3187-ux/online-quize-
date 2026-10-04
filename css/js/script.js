function validateQuiz() {

    let questions = document.querySelectorAll(
        'input[type="radio"]:checked'
    );

    let totalQuestions = document.querySelectorAll(
        'input[type="radio"]'
    );

    let questionCount = totalQuestions.length / 4;

    if (questions.length < questionCount) {

        alert("Please answer all questions before submitting the quiz.");

        return false;
    }

    return true;
}
