<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>


                    <div class="card-body">Home Page</div>
                    <div>
                        <p>
                            {{ componentMessage }}
                        </p>
                    </div>
                    <div>
                        <example-component></example-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

function randomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

export default {
    data: function() {
        return {
            componentMessage: 'Переданный текст в компонент',
            line_message: 'Строка номер ',
            count_lines: randomInteger(1, 256),
        }
    }
}
</script>
