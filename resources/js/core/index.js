require('./interceptor')

//Register components
const files = require.context('./../components', true, /\.js$/i);

files.keys().map(key => {
    const items = key.split('/')

    if (items[items.length - 1] == 'index.js') {
        require('./../components' + key.replace('.', ''))
    }
})