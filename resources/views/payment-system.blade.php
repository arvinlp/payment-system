<!DOCTYPE html>
<html>

<head></head>

<body>
    <form method="post" action="">
        @csrf
        <select name="gateway">
            <option value="Aqayepardakht">Aqayepardakht</option>
            <option value="NovinoPay">NovinoPay</option>
            <option value="NovinPal">NovinPal</option>
            <option value="Parspal">Parspal</option>
            <option value="Zarinpal">Zarinpal</option>
            <option value="Zibal">Zibal</option>
        </select>
        <select name="currency">
            <option value="rial">Rial</option>
            <option value="toman">Toman</option>
        </select>
        @if (!empty($merchants))
            <select name="merchant">
                @foreach ($merchants as $merchant)
                    <option value="{{ $merchant->merchant }}">{{ $merchant->merchant }}</option>
                @endforeach
            </select>
        @else
            <input name="merchant" type="text" placeholder="merchant">
        @endif
        <input name="amount" type="text" placeholder="amount">
        <input name="callback_url" type="text" placeholder="callback_url">
        <button name="submit">پرداخت</button>
    </form>
</body>

</html>
