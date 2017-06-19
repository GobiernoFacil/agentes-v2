// var definition
var Form, Questions, GFPNUDApp, endpoint,
    titleId              = "title",
    addQuestionBtn       = "add-question",
    questionTemplate     = "question-template",
    updateQuestionTemplate  = "update-question-template",
    updatedQuestionTemplate = "real-question-update-template",
    realQuestionTemplate = "real-question-template",
    answerTemplate       = "answer-template",
    realAnswerTemplate   = "real-answer-template",
    questionsList        = "questions-list";

// fake data
/*Form = {
  id   : 1,
  name : "Información del cuestionario"
};*/

var Form = document.getElementById('form');


//Questions = [{}];
//Answers = [{}];
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

    var anchor, remove, addOpt, REQFunc, ADOFunc, UQFunc,
        template = document.getElementById(realQuestionTemplate).innerHTML,
        li       = document.createElement("li"),
        list     = document.getElementById(questionsList),
        ul,
        _answers = answers.filter(function(a){
          return a.question_id == question.id;
        }, this);

    li.innerHTML = template;

    REQFunc      = this.removeQuestion.bind(this, li);
    ADOFunc      = this.addOption.bind(this, li, question);
    UQFunc       = this.updateQuestion.bind(this, question);


    anchor = li.querySelector(".question-name");
    remove = li.querySelector(".remove-question");
    addOpt = li.querySelector(".add-answer");
    ul     = li.querySelector("ul");

    anchor.innerHTML = question.question;

    list.appendChild(li);

    remove.addEventListener("click", REQFunc);
    remove.setAttribute("data-id", question.id);

    addOpt.addEventListener("click", ADOFunc);

    anchor.addEventListener("click", UQFunc);

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
        ROFunc   = null,
        SOFunc   = null;


    li.innerHTML = template;

    name     = li.querySelector(".answer-name");
    swtch    = li.querySelector(".switch-answer");
    remove   = li.querySelector(".remove-answer");

    name.innerHTML  = answer.value;
    swtch.innerHTML = !answer.selected ? "Seleccionar esta respuesta como correcta" : "Seleccionar esta respuesta como incorrecta";

    STOFunc = this.switchTrueOption.bind(this, li, answer);
    ROFunc  = this.removeOption.bind(this, li, answer);
    SOFunc  = this.updateOption.bind(this, li, answer);

    swtch.addEventListener("click", STOFunc);
    remove.addEventListener("click", ROFunc);
    name.addEventListener("click", SOFunc);

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
        UQFunc   = null,
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
    $.post(saveQuestionUrl, {question : value,_token:token,idQuiz:idQ}, function(res){
      anchor.innerHTML = res.question;
      Questions.push(res);
      remove.addEventListener("click", REQFunc);
      remove.setAttribute("data-id", res.id);

      ADOFunc  = that.addOption.bind(that, li, res);
      UQFunc  = that.updateQuestion.bind(that, res);
      addOpt.addEventListener("click", ADOFunc);
      anchor.addEventListener("click", UQFunc);
    }, "json");
    /**/
  },

  updateQuestion : function(question, e){

    console.log(question, e);
    var template = document.getElementById(updateQuestionTemplate).innerHTML,
        el       = e.target,
        parent   = el.parentNode,
        input, form, SUQFunc;


    parent.removeChild(el);
    parent.innerHTML = template;

    input = parent.querySelector("input[type='text']");
    form  = parent.querySelector("form");

    input.value = question.question;

    SUQFunc = this.saveUpdatedQuestion.bind(this, parent, question);
    form.addEventListener("submit", SUQFunc);
  },
  saveUpdatedQuestion : function(parent, question, e){
    e.preventDefault();

    var value    = e.target.querySelector("input[type='text']").value,
        template = document.getElementById(updatedQuestionTemplate).innerHTML,
        that     = this,
        anchor, UQFunc;

    if(!value) return;

    question.question = value;

    /* SERVER MUMBO YUMBO */
    $.get(fakeEndpoint, question, function(res){
      UQFunc           = that.updateQuestion.bind(that, res);
      parent.innerHTML = template;
      anchor           = parent.querySelector("a");
      anchor.addEventListener("click", UQFunc);
      anchor.innerHTML = res.question;
    }, "json");

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
    /* SERVER MUMBO YUMBO*/
    $.post(removeQuestionUrl, {id : id,_token:token}, function(res){
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
          selected : 0,
          _token   : token
        },
        template = document.getElementById(realAnswerTemplate).innerHTML,
        that     = this,
        name     = null,
        swtch    = null,
        remove   = null,
        STOFunc  = null,
        ROFunc   = null,
        UOFunc   = null;

    if(!value){
      return;
    }


    /* SERVER MUMBO YUMBO */
    $.post(saveAnswerUrl, answer, function(res){
      that.form.answers.push(res);

      li.innerHTML = template;

      STOFunc = that.switchTrueOption.bind(that, li, res);
      ROFunc  = that.removeOption.bind(that, li, res);
      UOFunc  = that.updateOption.bind(that, li, res);

      name     = li.querySelector(".answer-name");
      swtch    = li.querySelector(".switch-answer");
      remove   = li.querySelector(".remove-answer");

      name.innerHTML = res.value;

      swtch.addEventListener("click", STOFunc);
      remove.addEventListener("click", ROFunc);
      name.addEventListener("click", UOFunc);
    });
    /**/

  },

  updateOption : function(li, option, e){
    console.log(li, option, e);

    var template = document.getElementById(answerTemplate).innerHTML,
        ROFunc  = null,
        UOFunc   = null,
        submit, input, form, remove;


    li.innerHTML = template;
    submit = li.querySelector("input[type='submit']");
    input  = li.querySelector("input[type='text']");
    form   = li.querySelector("form");
    remove = li.querySelector(".remove-answer");

    submit.value = "editar";
    input.value  = option.value;

    ROFunc  = this.removeOption.bind(this, li, option);
    UOFunc  = this.updateSavedOption.bind(this, li, option);

    form.addEventListener("submit", UOFunc);
    remove.addEventListener("click", ROFunc);
  },

  updateSavedOption : function(li, option, e){
    e.preventDefault();

    var value    = li.querySelector("form").querySelector("input[type='text']").value,
        answer   = option,
        template = document.getElementById(realAnswerTemplate).innerHTML,
        that     = this,
        name     = null,
        swtch    = null,
        remove   = null,
        STOFunc  = null,
        ROFunc   = null,
        UOFunc   = null;

    if(!value){
      return;
    }

    answer.value = value;

    /* SERVER MUMBO YUMBO */
    $.get(fakeEndpoint, answer, function(res){
      answer = res;

      li.innerHTML = template;

      STOFunc = that.switchTrueOption.bind(that, li, res);
      ROFunc  = that.removeOption.bind(that, li, res);
      UOFunc  = that.updateOption.bind(that, li, res);

      name     = li.querySelector(".answer-name");
      swtch    = li.querySelector(".switch-answer");
      remove   = li.querySelector(".remove-answer");

      name.innerHTML = res.value;

      swtch.addEventListener("click", STOFunc);
      remove.addEventListener("click", ROFunc);
      name.addEventListener("click", UOFunc);
    });
  },


  removeEmptyOption : function(list, li, e){
    console.log(list, li, e);

    list.removeChild(li);
  },

  switchTrueOption : function(li, opt, e){
    e.preventDefault();

    var selected = +opt.selected,
        el       = li.querySelector(".switch-answer"),
        label    = selected ? "Seleccionar esta respuesta como correcta" : "Seleccionar esta respuesta como incorrecta";

    opt.selected = selected ? 0 : 1;

    /* SERVER MUMBO YUMBO */
    $.post(switchAnswerUrl, {opt,_token:token}, function(res){
      el.innerHTML = label;
    }, "json");
    /**/
  },

  removeOption : function(li, opt, e){
    e.preventDefault();
    /* SERVER MUMBO YUMBO */
    $.post(removeAnswerUrl, {opt,_token:token}, function(res){
      li.parentNode.removeChild(li);
    }, "json");
    /**/
  }
};

GFPNUDApp.initialize(Form);
