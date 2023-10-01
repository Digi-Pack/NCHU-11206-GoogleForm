<div v-for="i in (5 + ('1' === '1' ? 0 : 1)) " class="linear" :key="i">
    <label :for="'linear-' + (i - ('1' === '1' ? 0 : 1))">
      {{ i - ('1' === '1' ? 0 : 1) }}
    </label>
    <input type="radio" :name="'linear-' + i.id" :id="'linear-' + (i + 1 + 1)" :value="i">
  </div>

  <div v-for="i in (9 + ('1' === '1' ? 0 : 1)) " class="linear" :key="i">
    <label :for="'linear-' + (i - ('1' === '1' ? 0 : 1))">
      {{ i - ('1' === '1' ? 0 : 1) }}
    </label>
    <input type="radio" :name="'linear-' + i.id" :id="'linear-' + (i + 1 + 1)" :value="i">
  </div>
