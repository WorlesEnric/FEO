"use strict";
$(document).ready(function() {
  $("#text_demo1").tooltip({
    trigger: "focus",
    title: "Dismissible popover",
    content: "sdff fgfg"
  });
  $("#text_demo, #textarea_demo, #checkbox_demo, #select_demo").tm_editbale(
    "init",
    {
      theme: "dotted-line-theme",
      full_length: {
        outside: false,
        inside: true
      },
      outside_btn: {
        onshow: "",
        new_line: false,
        onhover: ""
      },
      inside_btn: {
        new_line: false,
        ok: "<i class='fa fa-check'></i>",
        cancel: "<i class='fa fa-close'></i>"
      }
    }
  );
  setTimeout(function() {
    $("#radio_demo").tm_editbale("init", {
      theme: "dotted-line-theme",
      full_length: {
        outside: false,
        inside: true
      },
      outside_btn: {
        onshow: "",
        new_line: false,
        onhover: ""
      },
      inside_btn: {
        new_line: false,
        ok: "<i class='fa fa-check'></i>",
        cancel: "<i class='fa fa-close'></i>"
      }
    });
  }, 350);
});

$('.radio').tm_editbale({
    type: 'radiolist',
    title: "Select yes or no",
    source: [{
        value: 0,
        text: 'No'
    }, {
        value: 1,
        text: 'Yes'
    }]
});