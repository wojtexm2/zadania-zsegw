const http = require('express');
const conf_data = require('./etc/conf.js');
const hbs = require('hbs');


const app = http();


app.set('view engine', 'hbs');
hbs.registerPartials(__dirname + '/views/parts');
app.set('views', './views');


app.get('/', (request, response) => {
    response.render('main', { title: 'MiniApp' });
    console.log('homepage_main');
});
app.get('/help', (request, response) => {
    response.render('help', { title: 'MiniApp' });
    console.log('homepage_main');
});


const router = require('./routes/api');
app.use('/', router);


app.listen(conf_data.port, () => {
    console.log('App started @ http://localhost:' + conf_data.port);
});
