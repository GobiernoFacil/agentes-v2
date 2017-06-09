// var definition
var Form, Questions, GFPNUDApp, endpoint,
    titleId              = "title",
    addQuestionBtn       = "add-question",
    questionTemplate     = "question-template",
    realQuestionTemplate = "real-question-template",
    answerTemplate       = "answer-template",
    realAnswerTemplate   = "real-answer-template",
    questionsList        = "questions-list"

// fake data
/*Form = {
  id   : 1,
  name : "Información del cuestionario"
};*/

var Form = = document.getElementById('form');
Questions = [{}];
Answers = [{}];
/*Questions = [{
  id : 1,
  question : "de qué color son las botas de súperman",
  order : 1,
  form : 1
}];
Answers = [
  {id : 1, value : "azules", question : 1, selected : 0},
  {id : 1, value : "verdes", question : 1, selected : 0},
  {id : 1, value : "rojas", question : 1, selected : 1}
];
*/

Form.questions = Questions;
Form.answers   = Answers;


// the app
var GFPNUDApp = {
  initialize : function(form){
    this.form = form;

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

    this.form.questions.forEach(function(q){
      if(q.question){
        this.renderQuestion(q, this.form.answers);
      }
    }, this);
  },

  renderQuestion : function(question, answers){
    var anchor, remove, addOpt, REQFunc, ADOFunc,
        template = document.getElementById(realQuestionTemplate).innerHTML,
        li       = document.createElement("li"),
        list     = document.getElementById(questionsList),
        ul,
        _answers = answers.filter(function(a){
          return a.question == question.id;
        }, this);

    li.innerHTML = template;

    REQFunc      = this.removeEmptyQuestion.bind(this, li);
    ADOFunc      = this.addOption.bind(this, li, question);


    anchor = li.querySelector(".question-name");
    remove = li.querySelector(".remove-question");
    addOpt = li.querySelector(".add-answer");
    ul     = li.querySelector("ul");

    anchor.innerHTML = question.question;

    list.appendChild(li);

    remove.addEventListener("click", REQFunc);
    remove.setAttribute("data-id", question.id);

    addOpt.addEventListener("click", ADOFunc);

    _answers.forEach(function(a){
      this.renderAnswer(ul, question, a);
      //var ADOFunc = this.addOption.bind(this, ul, question, a);
    }, this);

  },

  renderAnswer : function(ul, question, answer){
    var template = document.getElementById(realAnswerTemplate).innerHTML,
        li       = document.createElement("li"),
        name     = null,
        swtch    = null,
        remove   = null,
        STOFunc  = null,
        ROFunc   = null;


    li.innerHTML = template;

    name     = li.querySelector(".answer-name");
    swtch    = li.querySelector(".switch-answer");
    remove   = li.querySelector(".remove-answer");

    name.innerHTML  = answer.value;
    swtch.innerHTML = !answer.selected ? "hacer esta pregunta correcta" : "hacer esta respuesta incorrecta";

    STOFunc = this.switchTrueOption.bind(this, li, answer);
    ROFunc  = this.removeOption.bind(this, li, answer);

    swtch.addEventListener("click", STOFunc);
    remove.addEventListener("click", ROFunc);

    ul.appendChild(li);
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
        ADOFunc  = null;//this.addOption.bind(this, li);

    if(!value){
      return;
    }

    li.removeChild(form);
    li.innerHTML = template;

    anchor = li.querySelector(".question-name");
    remove = li.querySelector(".remove-question");
    addOpt = li.querySelector(".add-answer");

    /* SERVER MUMBO YUMBO */
    $.post(saveQuestionUrl, {question : value,_token:token}, function(res){
      anchor.innerHTML = res.question;
      Questions.push(res);
      remove.addEventListener("click", REQFunc);
      remove.setAttribute("data-id", res.id);

      ADOFunc  = that.addOption.bind(that, li, res);
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
    $.post(removeQuestionUrl, {id : id}, function(res){
      questions.splice(questions.indexOf(question), 1);
      li.parentNode.removeChild(li);
    }, "json");
    /* */
  },

  addOption : function(li, question, e){
    e.preventDefault();

    var list     = li.querySelector("ul"),
        template = document.getElementById(answerTemplate).innerHTML,
        li       = document.createElement("li"),
        form     = null,
        remove   = null,
        REAFunc  = null,
        SOFunc   = null;


    li.innerHTML = template;

    form    = li.querySelector("form");
    remove  = li.querySelector(".remove-answer");
    REOFunc = this.removeEmptyOption.bind(this, list, li);
    SOFunc  = this.saveOption.bind(this, li, question);

    list.appendChild(li);

    form.addEventListener("submit", SOFunc);
    remove.addEventListener("click", REOFunc);

    //console.log(list, e);
  },

  saveOption : function(li, question, e){
    e.preventDefault();

    var value = li.querySelector("form").querySelector("input[type='text']").value,
        answer = {
          value    : value,
          question : question.id,
          selected : 0
        },
        template = document.getElementById(realAnswerTemplate).innerHTML,
        that     = this,
        name     = null,
        swtch    = null,
        remove   = null,
        STOFunc  = null,
        ROFunc   = null;

    if(!value){
      return;
    }


    /* SERVER MUMBO YUMBO */
    $.get(fakeEndpoint, answer, function(res){
      that.form.answers.push(res);

      li.innerHTML = template;

      STOFunc = that.switchTrueOption.bind(that, li, res);
      ROFunc  = that.removeOption.bind(that, li, res);

      name     = li.querySelector(".answer-name");
      swtch    = li.querySelector(".switch-answer");
      remove   = li.querySelector(".remove-answer");

      name.innerHTML = res.value;

      swtch.addEventListener("click", STOFunc);
      remove.addEventListener("click", ROFunc);
    });
    /**/

  },

  removeEmptyOption : function(list, li, e){
    console.log(list, li, e);

    list.removeChild(li);
  },

  switchTrueOption : function(li, opt, e){
    e.preventDefault();

    var selected = +opt.selected,
        el       = li.querySelector(".switch-answer"),
        label    = selected ? "hacer esta pregunta correcta" : "hacer esta respuesta incorrecta";

    opt.selected = selected ? 0 : 1;

    /* SERVER MUMBO YUMBO */
    $.get(fakeEndpoint, {opt}, function(res){
      el.innerHTML = label;
    }, "json");
    /**/
  },

  removeOption : function(li, opt, e){
    e.preventDefault();

    /* SERVER MUMBO YUMBO */
    $.get(fakeEndpoint, {opt}, function(res){
      li.parentNode.removeChild(li);
    }, "json");
    /**/
  }
};

GFPNUDApp.initialize(Form);
