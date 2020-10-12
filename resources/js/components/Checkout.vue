<template>
    <div>
        <div class="title">
            <h1>Checkout Page</h1>
        </div>
        
        <div class="wrapper">
            <form>
                <h3>
                <i class="fas fa-shipping-fast"></i>
                Shipping Details
            </h3>
            <div class="name">
                <div>
                    <label for="f-name">First</label><br>
                    <input type="text" name="f-name">
                </div>
                <div>
                    <label for="l-name">Last</label><br>
                    <input type="text" name="l-name">
                </div>
            </div>
            <div class="street">
                <label for="name">Street</label><br>
                <input type="text" name="address">
            </div>
            <div class="address-info">
                <div>
                    <label for="city">City</label><br>
                    <input type="text" name="city">
                </div>
                <div>
                    <label for="state">State</label><br>
                    <input type="text" name="state">
                </div>
                <div>
                    <label for="zip">Zip</label><br>
                    <input type="text" name="zip">
                </div>
            </div>
            <h3>
                <i class="far fa-credit-card"></i> Payment Information
            </h3>
            <div class="cc-num">
                <label for="card-num">Credit Card No.</label><br>
                <input type="text" name="card-num">
            </div>
            <div class="cc-info">
                <div>
                    <label for="card-num">Exp</label><br>
                    <input type="text" name="expire">
                </div>
                <div>
                    <label for="card-num">CCV</label><br>
                    <input type="text" name="security">
                </div>
            </div>
            <div class="btns">
                <button class="btn btn-success" @click="confirm">Continue to checkout</button>
                <button class="btn btn-info" @click="backToCart">Back to Cart</button>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        confirm(){
            axios.post('/api/checkout')
            this.$router.push("home")
        },
        backToCart(){
            this.$router.push("cart")
        }
    }
}
</script>

<style lang="css">
    .wrapper{
        border-radius: 25px;
        border: 2px solid #A0A0A0;
        padding: 20px;
        margin: 20px;
        width: 700px;
        height: 500px;
    }

    input {
        width: 100%;
    }

    label {
        font-size: 12px;
        letter-spacing: 2px;
        color: #A0A0A0;
    }

    .btns{
        justify-content: space-between;
        display: flex;
        width: 100%;
        margin: 20px 0;
    }

    .name {
        justify-content: space-between;
        display: flex;
        width: 100%;

        div {
            width: 45%;
        }
    }

    .address-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;

        div {
            width: 30%;
        }
    }

    .cc-info {
        display: flex;
        justify-content: space-between;

        div {
            width: 45%;
        }
    }   

    
</style>