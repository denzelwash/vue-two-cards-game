<template>
  <div class="b-game">
    <div class="container">
      <div class="b-top">
        <div class="b-hello">
          <h1 :class="{active: gameStarted}">найди пару</h1>
          <p class="b-hello__desc">Правила просты, найди 2 одинаковы карточки.</p>
          <p class="b-hello__desc">Кто первый молодец, кто последний, тот лох.</p>
          <div class="b-hello__controls">
            <transition name="fade" v-on:after-leave="startAfterLeave">
                <button  v-if="!gameStarted && !showTime" class="btn" @click="startGame">Старт</button>
            </transition>
            <span v-if="showTime" class="timer">{{ time }}</span>  
          </div>
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
        <span class="b-progress__dot" :style="{left: progress + '%'}"></span>
        <span class="b-progress__bg" :style="{width: progress + '%'}"></span>
      </div>
      <div class="b-cards" :class="{pause, pause: !gameStarted}">
        <div 
          v-for="(item, i) in images" 
          :key="item.index" 
          class="b-cards__item"
          :class="{active: item.checked}"
          @click="open(item.id, i)"
        >
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
          id: 1,
          src: require('../assets/images/1.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 2,
          src: require('../assets/images/2.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 3,
          src: require('../assets/images/3.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 4,
          src: require('../assets/images/4.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 5,
          src: require('../assets/images/5.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 6,
          src: require('../assets/images/6.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 7,
          src: require('../assets/images/7.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 8,
          src: require('../assets/images/8.jpg'),
          checked: false,
          complete: false
        },
        {
          id: 9,
          src: require('../assets/images/9.jpg'),
          checked: false,
          complete: false
        },
      ],
      gameStarted: false,
      pause: false,
      showTime: false,
      time: 0,
      timerId: null,
      checkedId: null,
      checkedIndex: null,
      progress: 0
    }
  },
  computed: {

  },
  methods: {
    open(id, index) {
      this.pause = true
      if(this.checkedId === null) {
        this.checkedId = id
        this.checkedIndex = index
        this.images[index].checked = true
        setTimeout(() => {
          this.pause = false
        }, 300)
      } else {
        this.images[index].checked = true
        if(this.checkedId !== this.images[index].id) {
          setTimeout(() => {
            this.images[index].checked = false
            this.images[this.checkedIndex].checked = false
            this.checkedId = null
            this.checkedIndex = null
          }, 300)
        } else {
          setTimeout(() => {
            this.images[index].complete = true
            this.images[this.checkedIndex].complete = true
            this.checkedId = null
            this.checkedIndex = null
            this.progress += 100 / (this.images.length / 2)
            console.log(this.progress)
          }, 300)
        }
        setTimeout(() => {
          this.pause = false
        }, 600)
      }
    },
    startGame() {
      this.gameStarted = true
      this.timerId = setInterval(() => this.time++, 1000)
    },
    startAfterLeave() {
      this.showTime = true
    }
  },
  watch: {
    progress() {
      if(this.progress >= 100) {
        this.gameStarted = false
        this.pause = false
        clearInterval(this.timerId)
      }
    }
  },
  beforeMount() {
    this.images = this.images.concat(this.images.map((item) => ({...item}))).shuffle()
  }
}

Array.prototype.shuffle = function() {
  for (var i = this.length - 1; i > 0; i--) {
      var num = Math.floor(Math.random() * (i + 1));
      var d = this[num];
      this[num] = this[i];
      this[i] = d;
  }
  return this;
}

</script>


<style scoped lang="scss">

$time: 0.3s;

.b-game {}

.b-top {
  padding-top: 30px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 44px;
}

.b-hello {
  &__controls {
    margin-top: 1.5rem;
  }
}

h1 {
  position: relative;
  padding-left: 26px;
  font-weight: 700;
  font-size: 36px;
  text-transform: uppercase;
  color: #83CB53;
  margin-bottom: 18px;
  transition: all 0.3s;
  &.active {
    color: #FF9800;
  }
  &.active::before {
    background-color: #FF9800;
  }

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
    transition: all .3s;
  }
}
p {
  font-size: 18px;
  margin-bottom: 0;
}
.timer {  
  color: #FF9800;
  display: block;
  height: 46px;
  font-weight: 600;
  line-height: 46px;
  font-size: 32px;
  color: #444444;
  width: 100%;
  outline: none;
  transition: all 0.3s;
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
  outline: none;
  transition: all .3s;
  &:hover {
    background: #83CB53;
    color: #fff;
    border-color: #83CB53;
  }
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
  height: 4px;
  background-color: #F0F0F0;
  border-radius: 4px;
  &__dot {
    position: absolute;
    width: 10px;
    height: 10px;
    background-color: #83CB53;
    border-radius: 50%;
    top: 50%;
    transition: all 1s;
    transform: translateY(-50%);
    z-index: 2;
  }
  &__bg {
    position: absolute;
    width: 0%;
    height: 4px;
    background-color: #83CB53;
    transition: all 1s;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    z-index: 1;

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
    transition: all $time ease-in;
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
    transition: all $time ease-in;
    color: white;
    backface-visibility: hidden;
  }
}

.b-cards.pause {
  pointer-events: none;
}

.b-cards__item.active {
  pointer-events: none;
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

.fade-enter-active, .fade-leave-active {
  transition: opacity .3s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

</style>