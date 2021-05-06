module.exports = {
  chainWebpack: config => {
    config
      .plugin('html')
      .tap(args => {
          args[0].title = "Найди пару";
          return args;
      })
  },
  publicPath: process.env.NODE_ENV === 'production' ? '/vuetwocards/' : '/'
}