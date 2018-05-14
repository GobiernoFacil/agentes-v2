// var definition
var Form, Questions, GFPNUDApp, endpoint,
    titleId                 = "title",
    addQuestionBtn          = "add-question",
    questionTemplate        = "question-template",
    updateQuestionTemplate  = "update-question-template",
    updatedQuestionTemplate = "real-question-update-template",
    realQuestionTemplate    = "real-question-template",
    answerTemplate          = "answer-template",
    realAnswerTemplate      = "real-answer-template",
    questionTemplateOpen    = "question-template-open",
    questionsList           = "questions-list";

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

    if(question.type==='answers'){
        li.innerHTML = template;
    }else{
        li.innerHTML = document.getElementById(questionTemplateOpen).innerHTML;
    }

    REQFunc      = this.removeQuestion.bind(this, li);
    ADOFunc      = this.addOption.bind(this, li, question);
    UQFunc       = this.updateQuestion.bind(this, question);
    SROFunc      = this.switchRequiredOption.bind(this, li, question);


    anchor = li.querySelector(".question-name");
    type   = li.querySelector(".question-type");
    remove = li.querySelector(".remove-question");
    addOpt = li.querySelector(".add-answer");
    ul     = li.querySelector("ul");
    required = li.querySelector(".switch-required");
    requiredSpan = li.querySelector(".question-required");

    anchor.innerHTML = question.question;
    if(question.type === 'radio'){
      type.innerHTML = ' Pregunta en escala';
    }else if(question.type === 'open'){
      type.innerHTML = ' Pregunta abierta';
    }else{
      type.innerHTML = ' Pregunta de opción múltiple';
    }

    if(question.required){
      required.innerHTML = 'Seleccionar como pregunta opcional';
      requiredSpan.innerHTML = ' - Obligatoria';
    }else{
      required.innerHTML = 'Seleccionar como pregunta obligatoria';
      requiredSpan.innerHTML = ' - Opcional';
    }

    list.appendChild(li);

    remove.addEventListener("click", REQFunc);
    remove.setAttribute("data-id", question.id);
    if(question.type==='answers'){
      addOpt.addEventListener("click", ADOFunc);
    }

    anchor.addEventListener("click", UQFunc);
    required.addEventListener("click",SROFunc)

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
        input2   = document.getElementById('typeSelector'),
        input3   = document.getElementById('requiredSelector'),
        value    = input.value,
        value2   = input2.value,
        value3   = input3.value,
        li       = form.parentNode,
        template = document.getElementById(realQuestionTemplate).innerHTML,
        anchor   = null,
        remove   = null,
        addOpt   = null,
        that     = this,
        REQFunc  = this.removeQuestion.bind(this, li),
        UQFunc   = null,
        ADOFunc  = null;//this.addOption.bind(this, li);
        SROFunc  = null;

    if(!value || !value2 || !value3){
      return;
    }

    li.removeChild(form);
    if(value2==='answers'){
      li.innerHTML = template;
    }else{
      li.innerHTML = document.getElementById(questionTemplateOpen).innerHTML;
    }

    anchor = li.querySelector(".question-name");
    type   = li.querySelector(".question-type");
    required = li.querySelector(".switch-required");
    requiredSpan = li.querySelector(".question-required");
    remove = li.querySelector(".remove-question");
    if(value2 ==='answers'){
      addOpt = li.querySelector(".add-answer");
    }
    if(value2 === 'radio'){
      type.innerHTML = ' Pregunta en escala';
    }else if(value2 === 'open'){
      type.innerHTML = ' Pregunta abierta';
    }else{
      type.innerHTML = ' Pregunta de opción múltiple';
    }

    if(value3){
      required.innerHTML = 'Seleccionar como pregunta opcional';
      requiredSpan.innerHTML = ' - Obligatoria';
    }else{
      required.innerHTML = 'Seleccionar como pregunta obligatoria';
      requiredSpan.innerHTML = ' - Opcional';
    }

    /* SERVER MUMBO YUMBO */
    $.post(saveQuestionUrl, {question : value,type : value2, required : value3,_token:token,idQuiz:idQ}, function(res){
      anchor.innerHTML = res.question;
      Questions.push(res);
      remove.addEventListener("click", REQFunc);
      remove.setAttribute("data-id", res.id);

      ADOFunc  = that.addOption.bind(that, li, res);
      UQFunc   = that.updateQuestion.bind(that, res);
      SROFunc  = that.switchRequiredOption.bind(that,li,res);
      if(res.type ==='answers'){
        addOpt.addEventListener("click", ADOFunc);
      }
      anchor.addEventListener("click", UQFunc);
    }, "json");
    /**/
  },

  updateQuestion : function(question, e){

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
    question._token   = token;
    /* SERVER MUMBO YUMBO */
    $.post(updateQuestionUrl, question, function(res){
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
    answer._token = token;

    /* SERVER MUMBO YUMBO */
    $.post(updateAnswerUrl, answer, function(res){
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

  switchRequiredOption : function(li, opt, e){
    e.preventDefault();

    var selected = +opt.required,
        el       = li.querySelector(".switch-required"),
        span     = li.querySelector(".question-required"),
        label    = selected ? "Seleccionar como pregunta obligatoria" : "Seleccionar como pregunta opcional",
        labelSpa = selected ? " - Opcional" : " - Obligatoria" ;
        console.log(selected);

    opt.required = selected ? 0 : 1;

    /* SERVER MUMBO YUMBO */
    $.post(switchRequiredUrl, {opt,_token:token}, function(res){
      el.innerHTML = label;
      span.innerHTML = labelSpa;
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
