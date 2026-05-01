<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArbitrageWise - AI Crypto Arbitrage Platform</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #0A0E17;
            --card-bg: #0F172A;
            --border: #1E293B;
            --cyan: #38BDF8;
            --purple: #A855F7;
            --profit: #10B981;
            --text-muted: #94A3B8;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: var(--bg-dark); color: #E5E7EB; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        
        /* Header */
        header {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo {
            font-size: 1.7rem;
            font-weight: bold;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
        }
        .member { background: var(--card-bg); padding: 0.5rem 1.2rem; border-radius: 40px; font-size: 0.9rem; border: 1px solid var(--border); }
        .statistics { background: linear-gradient(135deg, var(--cyan), var(--purple)); padding: 0.5rem 1.2rem; border-radius: 40px; font-weight: bold; color: #0A0E17; }
        
        /* Dashboard Layout */
        .container-fluid { padding: 2rem; max-width: 1400px; margin: 0 auto; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 20px; padding: 1.5rem; transition: 0.2s; }
        .stat-card:hover { border-color: var(--cyan); transform: translateY(-2px); }
        .stat-card .label { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.5rem; }
        .stat-card .value { font-size: 2rem; font-weight: bold; }
        
        /* Arbitrage Table */
        .arbitrage-table { background: var(--card-bg); border: 1px solid var(--border); border-radius: 20px; overflow: hidden; margin-bottom: 2rem; }
        .table-header { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr 1fr; background: #1E293B; padding: 1rem; font-weight: bold; color: var(--text-muted); }
        .arbitrage-row { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr 1fr; padding: 1rem; border-bottom: 1px solid var(--border); cursor: pointer; transition: 0.2s; }
        .arbitrage-row:hover { background: #1E293B; }
        .profit { color: var(--profit); font-weight: bold; }
        
        /* Trade Panel */
        .trade-panel { background: var(--card-bg); border: 1px solid var(--border); border-radius: 20px; padding: 1.5rem; margin-top: 2rem; }
        .trade-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .percent-buttons { display: flex; gap: 0.5rem; }
        .percent-btn { background: #1E293B; border: none; padding: 0.4rem 1rem; border-radius: 20px; color: var(--text-muted); cursor: pointer; }
        .percent-btn.active { background: var(--cyan); color: #0A0E17; }
        .trade-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .trade-side { background: #1E293B; border-radius: 16px; padding: 1.2rem; }
        .trade-side select, .trade-side input { width: 100%; padding: 0.7rem; background: var(--card-bg); border: 1px solid var(--border); border-radius: 8px; color: white; margin: 0.5rem 0; }
        .price-display { font-size: 1.8rem; font-weight: bold; margin: 0.5rem 0; color: var(--cyan); }
        .profit-preview { text-align: center; padding: 1rem; background: #1E293B; border-radius: 12px; margin: 1rem 0; font-size: 1.2rem; }
        .execute-btn { width: 100%; padding: 1rem; background: var(--profit); border: none; border-radius: 12px; color: white; font-weight: bold; cursor: pointer; font-size: 1rem; margin-top: 1rem; }
        .timer-section { display: none; margin-top: 1rem; padding: 1rem; background: #1E293B; border-radius: 12px; text-align: center; }
        .timer-bar { height: 4px; background: #334155; border-radius: 2px; margin-top: 0.5rem; overflow: hidden; }
        .timer-progress { width: 100%; height: 100%; background: var(--cyan); }
        
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .table-header, .arbitrage-row { grid-template-columns: 1fr 1fr; gap: 0.5rem; }
            .trade-row { grid-template-columns: 1fr; }
            header { flex-direction: column; gap: 0.5rem; text-align: center; }
            .container-fluid { padding: 1rem; }
        }
    </style>
</head>
<body>

<header>
    <a href="/" class="logo">ARBITRA<span style="color:var(--cyan);">WISE</span></a>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <div class="member">Welcome, <?php echo $webtasks['username']; ?></div>
        <div class="statistics">💰 Balance: $<span id="userBalance"><?php echo number_format($webtasks['amount_balance'], 2); ?></span></div>
    </div>
</header>

<div class="container-fluid">
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card"><div class="label">💰 Total Balance</div><div class="value">$<span id="totalBalance"><?php echo number_format($webtasks['amount_balance'], 2); ?></span></div></div>
        <div class="stat-card"><div class="label">📊 Active Arbitrage</div><div class="value" id="activeTrades">0</div></div>
        <div class="stat-card"><div class="label">⚡ Total Profit</div><div class="value">$<span id="totalProfit">0.00</span></div></div>
        <div class="stat-card"><div class="label">📈 Success Rate</div><div class="value" id="successRate">0%</div></div>
    </div>

    <!-- Live Arbitrage Opportunities Table -->
    <div class="arbitrage-table">
        <div class="table-header">
            <span>💱 Pair</span>
            <span>🏦 Buy Exchange</span>
            <span>💰 Buy Price</span>
            <span>💸 Sell Exchange</span>
            <span>📈 Profit %</span>
        </div>
        <tbody id="opportunitiesBody">
            <!-- Dynamic rows will appear here via JavaScript -->
        </tbody>
    </div>

    <!-- Trade Execution Panel -->
    <div class="trade-panel">
        <div class="trade-header">
            <h3>🔄 Execute Arbitrage Trade</h3>
            <div class="percent-buttons">
                <button class="percent-btn" onclick="setPercentage(25)">25%</button>
                <button class="percent-btn" onclick="setPercentage(50)">50%</button>
                <button class="percent-btn" onclick="setPercentage(75)">75%</button>
                <button class="percent-btn active" onclick="setPercentage(100)">100%</button>
            </div>
        </div>
        
        <div class="trade-row">
            <div class="trade-side">
                <h4>🟢 BUY FROM</h4>
                <select id="buyExchange">
                    <option value="Binance">Binance</option>
                    <option value="Coinbase">Coinbase</option>
                    <option value="Kraken">Kraken</option>
                    <option value="KuCoin">KuCoin</option>
                </select>
                <div class="price-display" id="buyPrice">$0.00</div>
                <div>Amount (USDT)</div>
                <input type="number" id="tradeAmount" placeholder="Enter amount" value="100" oninput="updateTradePreview()">
            </div>
            <div class="trade-side">
                <h4>🔴 SELL ON</h4>
                <select id="sellExchange">
                    <option value="KuCoin">KuCoin</option>
                    <option value="Binance">Binance</option>
                    <option value="Coinbase">Coinbase</option>
                    <option value="Kraken">Kraken</option>
                </select>
                <div class="price-display" id="sellPrice">$0.00</div>
                <div>You'll receive</div>
                <div class="price-display" id="receiveAmount">0.0000 BTC</div>
            </div>
        </div>
        
        <div class="profit-preview" id="profitPreview">💰 Estimated Profit: $0.00</div>
        <button class="execute-btn" onclick="executeTrade()">EXECUTE ARBITRAGE TRADE</button>
        
        <div class="timer-section" id="timerSection">
            <div>Trade in progress: <span id="timerDisplay">03:00:00</span></div>
            <div class="timer-bar"><div class="timer-progress" id="timerProgress"></div></div>
            <div id="tradeResult"></div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js'); ?>"></script>
<script>
    // Simulated balance (from PHP)
    let userBalance = <?php echo (float)$webtasks['amount_balance']; ?>;
    let activeTrade = null;
    let tradeTimer = null;
    let currentProfitPreview = 0;
    
    // Price data
    let btcPrice = 65000;
    let ethPrice = 3200;
    
    // Exchanges and their simulated price variations
    const exchanges = ['Binance', 'Coinbase', 'Kraken', 'KuCoin'];
    let currentPrices = { Binance: 65000, Coinbase: 65150, Kraken: 64950, KuCoin: 65200 };
    
    function fetchPrices() {
        // Simulate small price fluctuations
        for (let ex of exchanges) {
            let change = (Math.random() - 0.5) * 100;
            currentPrices[ex] = Math.max(64000, Math.min(66000, currentPrices[ex] + change));
        }
        // Update UI
        updatePricesDisplay();
        generateOpportunityTable();
    }
    
    function updatePricesDisplay() {
        let buyEx = document.getElementById('buyExchange').value;
        let sellEx = document.getElementById('sellExchange').value;
        let buyPrice = currentPrices[buyEx];
        let sellPrice = currentPrices[sellEx];
        
        document.getElementById('buyPrice').innerHTML = `$${buyPrice.toFixed(2)}`;
        document.getElementById('sellPrice').innerHTML = `$${sellPrice.toFixed(2)}`;
        
        let amount = parseFloat(document.getElementById('tradeAmount').value) || 0;
        let receiveBtc = (amount / buyPrice).toFixed(6);
        document.getElementById('receiveAmount').innerHTML = `${receiveBtc} BTC`;
        
        updateTradePreview();
    }
    
    function updateTradePreview() {
        let buyEx = document.getElementById('buyExchange').value;
        let sellEx = document.getElementById('sellExchange').value;
        let buyPrice = currentPrices[buyEx];
        let sellPrice = currentPrices[sellEx];
        let amount = parseFloat(document.getElementById('tradeAmount').value) || 0;
        
        let receiveBtc = amount / buyPrice;
        let sellValue = receiveBtc * sellPrice;
        let profit = sellValue - amount;
        let profitPercent = (profit / amount) * 100;
        currentProfitPreview = profit;
        
        document.getElementById('profitPreview').innerHTML = `💰 Estimated Profit: $${profit.toFixed(2)} (${profitPercent.toFixed(2)}%)`;
        
        let btn = document.querySelector('.execute-btn');
        if (profit <= 0 || amount > userBalance) {
            btn.disabled = true;
            btn.style.background = '#6B7280';
            btn.innerText = amount > userBalance ? 'Insufficient Balance' : 'No Profit Opportunity';
        } else {
            btn.disabled = false;
            btn.style.background = '#10B981';
            btn.innerText = `EXECUTE ARBITRAGE TRADE (Profit: $${profit.toFixed(2)})`;
        }
    }
    
    function generateOpportunityTable() {
        let opps = [];
        let pairs = ['BTC/USDT', 'ETH/USDT'];
        
        for (let pair of pairs) {
            let prices = [];
            for (let ex of exchanges) {
                let price = pair === 'BTC/USDT' ? currentPrices[ex] : currentPrices[ex] * (ethPrice/btcPrice);
                prices.push({ ex: ex, price: price });
            }
            prices.sort((a,b) => a.price - b.price);
            let profitPercent = ((prices[prices.length-1].price - prices[0].price) / prices[0].price) * 100;
            if (profitPercent > 0.1) {
                opps.push({
                    pair: pair,
                    buyEx: prices[0].ex,
                    buyPrice: prices[0].price,
                    sellEx: prices[prices.length-1].ex,
                    sellPrice: prices[prices.length-1].price,
                    profitPercent: profitPercent
                });
            }
        }
        
        let tbody = document.getElementById('opportunitiesBody');
        if (opps.length === 0) {
            tbody.innerHTML = '<div class="arbitrage-row" style="text-align:center;">No opportunities at the moment. Scanning prices...</div>';
        } else {
            tbody.innerHTML = opps.map(o => `
                <div class="arbitrage-row" onclick="selectOpportunity('${o.buyEx}', '${o.sellEx}')">
                    <span>${o.pair}</span>
                    <span>${o.buyEx}</span>
                    <span>$${o.buyPrice.toFixed(2)}</span>
                    <span>${o.sellEx}</span>
                    <span class="profit">+${o.profitPercent.toFixed(2)}%</span>
                </div>
            `).join('');
        }
    }
    
    function selectOpportunity(buyEx, sellEx) {
        document.getElementById('buyExchange').value = buyEx;
        document.getElementById('sellExchange').value = sellEx;
        updatePricesDisplay();
    }
    
    function setPercentage(pct) {
        document.querySelectorAll('.percent-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        let maxAmount = userBalance;
        let amount = Math.floor(maxAmount * (pct / 100));
        document.getElementById('tradeAmount').value = amount;
        updateTradePreview();
    }
    
    async function executeTrade() {
        let amount = parseFloat(document.getElementById('tradeAmount').value) || 0;
        if (amount > userBalance) {
            alert("Insufficient balance. Please deposit funds.");
            return;
        }
        if (currentProfitPreview <= 0) {
            alert("No profit opportunity. Please select different exchanges.");
            return;
        }
        
        // Deduct from balance
        userBalance -= amount;
        document.getElementById('totalBalance').innerText = userBalance.toFixed(2);
        document.getElementById('userBalance').innerText = userBalance.toFixed(2);
        
        let profit = currentProfitPreview;
        
        activeTrade = {
            amount: amount,
            profit: profit,
            startTime: Date.now(),
            endTime: Date.now() + (3 * 60 * 60 * 1000)
        };
        
        let timerSection = document.getElementById('timerSection');
        timerSection.style.display = 'block';
        
        startTradeTimer(profit);
        alert(`✅ Trade executed! $${amount} locked for 3 hours. Expected profit: $${profit.toFixed(2)}`);
        
        // Update active trades count
        document.getElementById('activeTrades').innerText = '1';
    }
    
    function startTradeTimer(profit) {
        if (tradeTimer) clearInterval(tradeTimer);
        
        tradeTimer = setInterval(() => {
            let remaining = activeTrade.endTime - Date.now();
            if (remaining <= 0) {
                clearInterval(tradeTimer);
                completeTrade(profit);
                return;
            }
            let hours = Math.floor(remaining / 3600000);
            let minutes = Math.floor((remaining % 3600000) / 60000);
            let seconds = Math.floor((remaining % 60000) / 1000);
            document.getElementById('timerDisplay').innerText = `${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
            let progress = (remaining / (3 * 60 * 60 * 1000)) * 100;
            document.getElementById('timerProgress').style.width = `${progress}%`;
        }, 1000);
    }
    
    function completeTrade(profit) {
        userBalance += activeTrade.amount + profit;
        document.getElementById('totalBalance').innerText = userBalance.toFixed(2);
        document.getElementById('userBalance').innerText = userBalance.toFixed(2);
        document.getElementById('activeTrades').innerText = '0';
        document.getElementById('totalProfit').innerText = (parseFloat(document.getElementById('totalProfit').innerText) + profit).toFixed(2);
        
        let timerSection = document.getElementById('timerSection');
        timerSection.style.display = 'none';
        
        let resultDiv = document.getElementById('tradeResult');
        resultDiv.innerHTML = `<div style="background:#10B981; padding:1rem; border-radius:8px; margin-top:1rem;">✅ Trade completed! Profit: $${profit.toFixed(2)} credited to your balance.</div>`;
        setTimeout(() => { resultDiv.innerHTML = ''; }, 5000);
        
        activeTrade = null;
        if (tradeTimer) clearInterval(tradeTimer);
    }
    
    // Update success rate based on trades
    let totalTrades = 0;
    function updateSuccessRate() {
        totalTrades++;
        let successRate = Math.min(98, 85 + Math.floor(Math.random() * 13));
        document.getElementById('successRate').innerText = `${successRate}%`;
    }
    
    // Auto-refresh prices every 3 seconds
    setInterval(() => {
        fetchPrices();
    }, 3000);
    
    // Initial load
    fetchPrices();
    
    // Add listeners for dropdown changes
    document.getElementById('buyExchange').addEventListener('change', updatePricesDisplay);
    document.getElementById('sellExchange').addEventListener('change', updatePricesDisplay);
    document.getElementById('tradeAmount').addEventListener('input', updateTradePreview);
</script>
</body>
</html>
