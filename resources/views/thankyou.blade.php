<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
    body {
        background: #ebedef;
        margin: 0 !important;
    }	
    .wrapper-1{
        width:100%;
        height:100vh;
        display: flex;
        flex-direction: column;
        background: #fff;
        box-shadow: 0 0.5rem 1.5rem 0.5rem rg
    }
    .thankyou-box{
        padding :30px;
        text-align:center;
    }
    .thankyou-box h1{
        font-family: 'Kaushan Script', cursive;
        font-size: 3em;
        letter-spacing: 3px;
        color: #d52027;
        margin: 0;
        /* margin-bottom: 20px;*/
    }
    .thankyou-box h4 {
        font-family: 'Kaushan Script', cursive;
        font-size: 2em;
        letter-spacing: 2px;
        color: #d52027;
        margin: 0 0 30px;
    }
    .thankyou-box p{
        margin:0;
        font-size:1.3em;
        color:#000;
        font-family: 'Source Sans Pro', sans-serif;
        letter-spacing:1px;
    }
    .go-home{
        background: #d52027;
        border: 0;
        padding: 10px 20px;
        font-family: 'MYRIADPRO-SEMIBOLD';
        font-size: 18px;
        border-radius: 32px;
        color: #fff;
        margin-top: 30px;
    }
    .go-home a {
        color: #fff;
        text-decoration: none;
    }
    @media (min-width:360px){
        h1{
            font-size:4.5em;
        }
        .go-home{
            margin-bottom:20px;
        }
    }

    @media (min-width:600px){
        .content{
            max-width: 1000px;
            margin: 0 auto;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .wrapper-1{
            height: initial;
            max-width:620px;
            margin:0 auto;
            box-shadow: 0 0.5rem 1.5rem 0.5rem rgb(0 0 0 / 8%);
        }
    }

</style>
</head>
<body>
    <div class=content>
        <div class="wrapper-1">
            <div class="thankyou-box">
                <h1>Thank you!</h1>
                <h4>Registration Successful</h4>
                <p>Thanks for the Registration </p>
                <button class="go-home">
                    <a href="{{ route('login') }}" class="color-red">Visit Website</a>
                </button>
            </div>
        </div>
    </div>
</body>
</html>