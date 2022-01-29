<template>
  <div class="row">
    <div class="row row-cards">
      <div class="col-md-5">
        <div class="row row-cards">
          <div class="col-12">
            <CardOwnerTicket />
          </div>
          <div class="col-12">
            <CardResponsibleTicket />
          </div>
          <div class="col-12">
            <CardInfoTicket />
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <CardViewTicket />
      </div>
    </div>
  </div>
</template>

<script>
import CardInfoTicket from "~/components/cards/CardInfoTicket.vue";
import CardOwnerTicket from "~/components/cards/CardOwnerTicket.vue";
import CardViewTicket from "~/components/cards/CardViewTicket.vue";
export default {
    name: "TicketPage",
    mounted() {
        console.log("mounted");
    },
    updated() {
        console.log("updated");
    },
    components: { CardInfoTicket, CardOwnerTicket, CardViewTicket }
}
</script>
