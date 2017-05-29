// var definition
var Form, Questions, GFPNUDApp, endpoint,
    titleId              = "title",
    addQuestionBtn       = "add-question",
    questionTemplate     = "question-template",
    realQuestionTemplate = "real-question-template",
    questionsList        = "questions-list";

// fake data
Form = {
  id   : 1,
  name : "primer formulario"
};

Questions = [];

Form.questions = Questions;


// the app
GFPNUDApp = {
  initialize : function(form){
    this.form = Form;

    this.addQuestion  = this.addQuestion.bind(this);
    this.saveQuestion = this.saveQuestion.bind(this);

    this.renderUI(this.form);
    this.enableUI();
  },

  renderUI : function(form){
    var title = document.getElementById(titleId);

    title.innerHTML = form.name;
  },

  enableUI : function(){
    var addQuestion = document.getElementById(addQuestionBtn);

    addQuestion.addEventListener("click", this.addQuestion);
  },

  addQuestion : function(e){
    e.preventDefault();

    var template = document.getElementById(questionTemplate).innerHTML,
        list     = document.getElementById(questionsList),
        li       = document.createElement("li"),
        form     = null;

    li.innerHTML = template;
    form = li.querySelector("form");
    form.addEventListener("submit", this.saveQuestion);

    list.appendChild(li);
  },

  saveQuestion : function(e){
    e.preventDefault();
    
    var form     = e.target,
        input    = form.querySelector("input[type='text']"),
        value    = input.value,
        li       = form.parentNode,
        template = document.getElementById(realQuestionTemplate).innerHTML;

    if(!value){
      return;
    }

    li.removeChild(form);
    li.innerHTML = template;
  },

  updateQuestion : function(question, data){

  },

  removeQuestion : function(question){

  },

  addOption : function(){

  },

  removeOption : function(){

  }
};

GFPNUDApp.initialize();