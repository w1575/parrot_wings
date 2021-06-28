<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">About</div>

                    <div class="card-body">About Page</div>
                </div>
            </div>
            <div class="col-8">
                Привет {{ componentMessage }}
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            componentMessage: 'Страница транзакций'
        }
    }


}

</script>
