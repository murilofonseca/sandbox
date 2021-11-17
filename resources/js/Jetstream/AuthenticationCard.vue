<template>
  <div class="container">
    <div class="row d-flex flex-column min-vh-100 justify-content-center align-items-center">
      <div class="col-sm-12 col-md-6 col-lg-4">
        <div>
          <slot name="logo" />
        </div>
        <div class="card shadow px-3">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
