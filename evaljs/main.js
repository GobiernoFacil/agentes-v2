// var definition
var Form, Questions, GFPNUDApp, endpoint,
    titleId              = "title",
    addQuestionBtn       = "add-question",
    questionTemplate     = "question-template",
    realQuestionTemplate = "real-question-template",
    answerTemplate       = "answer-template",
    questionsList        = "questions-list",
    fakeEndpoint         = "/fake.php";

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
        form     = null,
        remove   = null,
        REQFunc  = null;

    li.innerHTML = template;
    form         = li.querySelector("form");
    remove       = li.querySelector(".remove-question");
    REQFunc      = this.removeEmptyQuestion.bind(this, li);
    
    list.appendChild(li);
    form.addEventListener("submit", this.saveQuestion);
    remove.addEventListener("click", REQFunc);
  },

  saveQuestion : function(e){
    e.preventDefault();
    
    var form     = e.target,
        input    = form.querySelector("input[type='text']"),
        value    = input.value,
        li       = form.parentNode,
        template = document.getElementById(realQuestionTemplate).innerHTML,
        anchor   = null,
        remove   = null,
        addOpt   = null,
        that     = this,
        REQFunc  = this.removeQuestion.bind(this, li),
        ADOFunc  = this.addOption.bind(this, li);

    if(!value){
      return;
    }

    li.removeChild(form);
    li.innerHTML = template;

    anchor = li.querySelector(".question-name");
    remove = li.querySelector(".remove-question");
    addOpt = li.querySelector(".add-answer");

    /* SERVER MUMBO YUMBO */
    $.get(fakeEndpoint, {question : value}, function(res){
      anchor.innerHTML = res.question;
      Questions.push(res);
      remove.addEventListener("click", REQFunc);
      remove.setAttribute("data-id", res.id);

      addOpt.addEventListener("click", ADOFunc);
    }, "json");
    /**/
  },

  updateQuestion : function(question, data){

  },

  removeEmptyQuestion : function(li, e){
    e.preventDefault();
    li.parentNode.removeChild(li);
  },

  removeQuestion : function(li, e){
    e.preventDefault();

    var id        = e.target.getAttribute("data-id"),
        questions = this.form.questions,
        question  = questions.filter(function(q){
                     return q.id == id;
                   })[0];

    /* SERVER MUMBO YUMBO */
    $.get(fakeEndpoint, {id : id}, function(res){
      questions.splice(questions.indexOf(question), 1);
      li.parentNode.removeChild(li);
    }, "json");
    /**/
  },

  addOption : function(li, e){
    e.preventDefault();

    var list     = li.querySelector("ul"),
        template = document.getElementById(answerTemplate).innerHTML,
        li       = document.createElement("li"),
        form     = null,
        remove   = null,
        REAFunc  = null;


    li.innerHTML = template;

    form    = li.querySelector("form");
    remove  = li.querySelector(".remove-answer");
    REOFunc = this.removeEmptyOption.bind(this, list, li);

    list.appendChild(li);

    form.addEventListener("submit", this.saveOption);
    remove.addEventListener("click", REOFunc);

    //console.log(list, e);
  },

  saveOption : function(e){
    e.preventDefault();
    
    console.log(e);
  },

  removeEmptyOption : function(list, li, e){
    console.log(list, li, e);
  },

  removeOption : function(){

  }
};

GFPNUDApp.initialize();