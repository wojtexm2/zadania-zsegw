const http = require('express')

const rt = http.Router()

//routes
rt.get('/', (request, response)=>{
	response.send('Strona główna - witamy')
	console.log('New connection')
})

const selfTest = require('../services/selfTest.js')
rt.get('/self-test', selfTest )

const winUser = require('../services/winUser.js')
rt.get('/win-user', winUser)

module.exports = rt
