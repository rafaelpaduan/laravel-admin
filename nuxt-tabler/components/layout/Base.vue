<template>
    <div class="page">
      
      <Sidebar />

      <div class="page-wrapper">
        
        <PageTitle />

        <div class="page-body">
          <div class="container-fluid">
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
</template>