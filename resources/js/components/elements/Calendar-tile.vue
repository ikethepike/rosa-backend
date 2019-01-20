<template>
  <div class="calendar-tile" :class="week.date">
    <header class="calendar-heading">
      <span class="calendar-heading">
        Tu
        <span class="week">{{ week.number }}</span>
      </span>
    </header>

    <div class="classes"></div>
  </div>
</template>
