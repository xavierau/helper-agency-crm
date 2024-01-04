<template>
  <CFooter :fixed="false">
    <div>
      <a href="https://anacreation.com" target="_blank">A & A Creation</a>
      <span class="ml-1">&copy; {{ new Date().getFullYear() }} </span>
    </div>
    <div class="mfs-auto">
    </div>
  </CFooter>
</template>

<script>
export default {
    name: 'TheFooter'
}
</script>
