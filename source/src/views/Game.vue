<template>
  <div class="b-game">
    <div class="container">
      <div class="b-top">
        <div class="b-hello">
          <h1 :class="{active: gameStarted}">найди пару</h1>
          <p class="b-hello__desc">Правила просты, найди 2 одинаковы карточки.</p>
          <p class="b-hello__desc">Кто первый молодец, кто последний, тот лох.</p>
          <div class="b-hello__controls">
            <transition name="fade" mode="out-in">
                <button  v-if="!gameStarted && progress === 0" class="btn" @click="startGame">Старт</button>
                <span v-else class="timer">{{ time }}</span>
            </transition>
            <transition name="fade">
              <div v-if="gameСomplete" class="b-hello__complete-btns">
                <button class="btn" @click="repeatGame">Заново</button>
                <button class="btn">Сохранить</button>
              </div>
            </transition>
          </div>
        </div>
        <div class="b-score">
          <transition name="fade" mode="out-in">
            <ul v-if="resultsLength" class="b-score__list">
              <li class="b-score__item"
                v-for="(item, i) in results"
                :key="item.id_result"
              >
                <b>{{ i + 1}}.</b>
                <span>{{ item.name }}</span>
                <span class="b-score__time">{{ item.time }} сек.</span>
              </li>
            </ul>
            <Loader v-else/>
          </transition>
        </div>
      </div>
      <div class="b-progress">
        <span class="b-progress__dot" :style="{left: progress + '%'}"></span>
        <span class="b-progress__bg" :style="{width: progress + '%'}"></span>
      </div>
      <div class="b-cards" :class="{pause}">
        <div 
          v-for="(item, i) in images" 
          :key="item.index" 
          class="b-cards__item"
          :class="{active: item.checked}"
          @click="openCard(item.id, i)"
        >
          <span class="b-cards__question"></span>
          <img class="b-cards__image" :src="item.src" alt="">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loader from '@/components/Loader.vue'

export default {
  components: {
    Loader
  },
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
      time: 0,
      timerId: null,
      checkedId: null,
      checkedIndex: null,
      progress: 0,
      results: []
    }
  },
  computed: {
    resultsLength() {
      return this.results.length
    },
    gameСomplete() {
      return this.progress >= 100
    }
  },
  methods: {
    openCard(id, index) {
      if (!this.gameStarted) return
      if(this.checkedId === null) {
        this.checkedId = id
        this.checkedIndex = index
        this.images[index].checked = true
      } else {
        this.pause = true
        this.images[index].checked = true
        if(this.checkedId !== this.images[index].id) {
          setTimeout(() => {
            this.images[index].checked = false
            this.images[this.checkedIndex].checked = false
            this.checkedId = null
            this.checkedIndex = null
            this.pause = false
          }, 600)
        } else {
          setTimeout(() => {
            this.images[index].complete = true
            this.images[this.checkedIndex].complete = true
            this.checkedId = null
            this.checkedIndex = null
            this.progress += 100 / (this.images.length / 2)
            this.pause = false
          }, 300)
        }
      }
    },
    startGame() {
      this.gameStarted = true
      this.timerId = setInterval(() => this.time++, 1000)
    },
    repeatGame() {
      this.time = 0
      this.timerId = null
      this.checkedId = null
      this.checkedIndex = null
      this.progress = 0
      this.images.forEach((item) => {
        item.checked = false
        item.complete = false
      })
      this.images = this.images.shuffle()
    }
  },
  watch: {
    progress() {
      if(this.gameСomplete) {
        this.gameStarted = false
        clearInterval(this.timerId)
      }
    }
  },
  async beforeMount() {
    this.images = this.images.concat(this.images.map((item) => ({...item})))
    try {
      const response = await fetch('http://1vue-two-cards/api/getResults.php')
      this.results = await response.json()
    } catch(e) {
      console.error(e)
    }
    
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


<style lang="scss">

</style>