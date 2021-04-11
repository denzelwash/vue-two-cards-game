<template>
  <div class="b-game">
    <div class="container">
      <div class="b-top">
        <div class="b-hello">
          <h1>найди пару</h1>
          <p class="b-hello__desc">Правила просты, найди 2 одинаковы карточки.</p>
          <p class="b-hello__desc">Кто первый молодец, кто последний, тот лох.</p>
          <button class="btn">Старт</button>
        </div>
        <ul class="b-score">
          <li class="b-score__item">
            <b>1.</b>
            <span>Конечно же я</span>
            <span class="b-score__time">2:43</span>
          </li>
          <li class="b-score__item">
            <b>2.</b>
            <span>Люба</span>
            <span class="b-score__time">3:05</span>
          </li>
          <li class="b-score__item">
            <b>3.</b>
            <span>Коля Иванов</span>
            <span class="b-score__time">15:43</span>
          </li>
          <li class="b-score__item">
            <b>4.</b>
            <span>Степан Петров</span>
            <span class="b-score__time">20:43</span>
          </li>
        </ul>
      </div>
      <div class="b-progress">
        <span class="b-progress__indicator"></span>
      </div>
      <div class="b-cards">
        <div v-for="(item, i) in imagesArr" :key="i" class="b-cards__item" @click="open">
          <span class="b-cards__question"></span>
          <img class="b-cards__image" :src="item.src" alt="">
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default{
  data() {
    return {
      images: [
        {
          src: require('../assets/images/1.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/2.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/3.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/4.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/5.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/6.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/7.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/8.jpg'),
          status: 0
        },
        {
          src: require('../assets/images/9.jpg'),
          status: 0
        },
      ]
    }
  },
  computed: {
    imagesArr() {
      return this.images.concat(this.images)
    }
  },
  methods: {
    open($event) {
      $event.target.parentNode.classList.toggle('active')
    }
  }
}
</script>


<style scoped lang="scss">
  .b-game {}

  .b-top {
    padding-top: 40px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 44px;
  }

  h1 {
    position: relative;
    padding-left: 26px;
    font-weight: 700;
    font-size: 36px;
    text-transform: uppercase;
    color: #83CB53;
    margin-bottom: 18px;

    &::before {
      position: absolute;
      content: '';
      width: 10px;
      height: 50px;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      background: #A1B5D0;
      border-radius: 6px;
    }
  }
  p {
    font-size: 18px;
    margin-bottom: 0;
  }
  .btn {
    background: #FFFFFF;
    border: 2px solid #A1B5D0;
    border-radius: 40px;
    height: 46px;
    font-weight: 600;
    font-size: 18px;
    color: #83CB53;
    width: 100%;
    max-width: 191px;
    margin-top: 1.5rem;
    outline: none;
  }
  .b-score {
    padding-top: 42px;
    margin: 0;
    padding: 0;
    list-style: none;
    width: 100%;
    max-width: 310px;
    &__item {
      border: 1px solid #CCCCCC;
      border-radius: 6px;
      padding: 8px 16px;
      margin-bottom: 8px;
      display: flex;
      &:last-child {
        margin-bottom: 0;
      }
      b {
        margin-right: 6px;
      }
    }
    &__time {
      margin-left: auto;
    }
  }
  .b-progress {
    position: relative;
    margin-bottom: 44px;
    width: 100%;
    height: 2px;
    background-color: #F0F0F0;
    span {
      position: absolute;
      width: 8px;
      height: 8px;
      background-color: #83CB53;
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
    }
  }
  .b-cards {
    display: flex;
    flex-wrap: wrap;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    grid-template-rows: auto auto;
    grid-gap: 15px;
    padding-bottom: 100px;
    &__item {
      position: relative;
      width: 100%;
      padding-bottom: 100%;
      border-radius: 15px;
      perspective: 500px;
      float: left;
    }
    &__question {
      display: block;
      background: #A1B5D0 url('../assets/images/question.svg') no-repeat center;
      background-size: 50%;
      position:absolute;
      width: 100%;
      height: 100%;
      box-sizing: border-box;
      transition: all 0.5s ease-in;
      color: white;
      background-color: #A1B5D0;
      padding: 10px;
      backface-visibility: hidden;
      border-radius: 15%;
      cursor: pointer;
    }
    &__image {
      display: block;
      position:absolute;
      width: 100%;
      height: 100%;
      box-sizing: border-box;
      transition: all 0.5s ease-in;
      color: white;
      backface-visibility: hidden;
    }
  }
  .b-cards__item.active .b-cards__question, .b-cards__item.flip .b-cards__question{
    transform: rotateY(180deg);
  }
  .b-cards__item.active .b-cards__image, .b-cards__item.flip .b-cards__image{
    transform: rotateY(0deg);
  }
  .b-cards__item .b-cards__image{
    transform: rotateY(-180deg);
  }

</style>