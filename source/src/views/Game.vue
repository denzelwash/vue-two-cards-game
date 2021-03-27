<template>
  <div class="b-game">
    <div class="container">
      <div class="b-top">
        <div class="b-hello">
          <h1>найди пару</h1>
          <p class="b-hello__desc">Правила просты, найди 2 одинаковы карточки.</p>
          <p class="b-hello__desc">Кто первый малодец, кто последний, тот лох.</p>
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

      </div>
    </div>
  </div>
</template>

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

</style>