var express = require('express');
var app = express()

app.set('view engine','ejs');

app.all('/',function(req,res){
    res.render('abc',{
        'title':'123',
        'username'
    })
})