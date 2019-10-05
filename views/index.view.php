<style type="text/css">

.part1{
    padding: 45px;
    display: flex;
    flex-direction: row;
    background-color: #fff;
    margin:0px;
}
.part1 div{
    padding: 10px;
}
.part1txt{
    width: 70%;
}

.part2{
    padding-top: 10px;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    width: 100%;
    margin: auto;
    background-color: #93C5FF;
}
.part2content{
    display: flex;
    flex-direction: column;
    width: 20%;
    margin: auto;
    text-align: justify;
}
</style>


<div class="content">

	 <div class="part1">

        <div class="part1txt">
            <h1>Présentation</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lobortis risus id leo suscipit, in sagittis lorem lobortis. Cras ullamcorper purus et sapien varius pretium. Nulla facilisi. Nullam aliquam, massa in rhoncus ultrices, leo risus molestie mi, in rutrum ante neque eget nibh. Proin in nibh diam. Nullam blandit augue at odio pulvinar lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris elementum, tortor et placerat malesuada, dolor augue bibendum lectus, ac commodo dui nulla in nisi.</p>
        </div>
    </div>
    <div class="part2">
        <table class="part2content" width="auto">
            <tr>
                <td align="center">
                    <img style="margin:auto;" src="ressources/sales.png" width="80px">
                </td>
            <tr>
                <td>
                    <p style="text-align: justify;padding-left:10px;padding-right:10px;">Ici vous pourrez trouver les meilleurs articles choisis par la communauté ainsi que les promotions du moment.</p>
                </td>
            </tr>
        </table>
        <table class="part2content" width="auto">
            <tr>
                <td align="center">
                    <img src="ressources/customer-service.png" width="80px">
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: justify;padding-left:10px;padding-right:10px;">Contacter nous à ce numéro pour plus d'information ou pour profiter du service après-vente.</p>
                </td>
            </tr>
        </table>
        <table class="part2content" width="auto">
            <tr>
                <td align="center">
                    <img src="ressources/shopping.png" width="80px">
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: justify;padding-left:10px;padding-right:10px;">Ici vous pourrez trouver les meilleurs articles choisis par la communauté ainsi que les promotions du moment.</p>
                </td>
            </tr>
        </table>
        <table class="part2content" width="auto">
            <tr>
                <td align="center">
                    <img src="ressources/reward.png" width="80px">
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: justify;padding-left:10px;padding-right:10px;">Chaque article doit passer par la case validation attendez quelques instants notre équipe vas analyser votre offre.</p>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- on inclut le footer du site tout à la fin car le but est de le charger en dernier-->
    <?php require_once('include/footer.php'); ?>

</div>
