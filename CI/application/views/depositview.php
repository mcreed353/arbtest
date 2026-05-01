<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArbitrageWise - Deposit Funds</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0A0E17; color: #E5E7EB; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        
        /* Premium Header */
        .premium-header {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(56, 189, 248, 0.2);
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
            background: linear-gradient(135deg, #38BDF8, #A855F7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
        }
        .user-info {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .welcome-badge {
            background: #0F172A;
            border: 1px solid #1E293B;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-size: 0.9rem;
        }
        .balance-badge {
            background: linear-gradient(135deg, #38BDF8, #A855F7);
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-weight: bold;
            color: #0A0E17;
        }
        
        /* Main Container */
        .deposit-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }
        
        /* Premium Card */
        .premium-card {
            background: #0F172A;
            border: 1px solid #1E293B;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .card-header {
            background: linear-gradient(135deg, #1E293B, #0F172A);
            padding: 1.5rem;
            border-bottom: 1px solid #1E293B;
        }
        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .card-body {
            padding: 1.5rem;
        }
        
        /* Info Box */
        .info-box {
            background: #1E293B;
            border-radius: 16px;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #38BDF8;
        }
        .info-box h4 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94A3B8;
            margin-bottom: 0.75rem;
        }
        .info-box p {
            margin: 0.25rem 0;
            font-size: 0.9rem;
        }
        .info-box strong {
            color: #38BDF8;
        }
        
        /* Address Box */
        .address-box {
            background: #1E293B;
            border-radius: 16px;
            padding: 1rem;
            margin: 1rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .address-box code {
            font-family: monospace;
            font-size: 0.85rem;
            word-break: break-all;
            color: #38BDF8;
            flex: 1;
        }
        .copy-btn {
            background: #38BDF8;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            color: #0A0E17;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .copy-btn:hover {
            background: #A855F7;
            color: white;
        }
        
        /* Form Inputs */
        .form-group {
            margin-bottom: 1.2rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #94A3B8;
        }
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            background: #1E293B;
            border: 1px solid #334155;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #38BDF8;
            box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.2);
        }
        
        /* Submit Button */
        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #38BDF8, #A855F7);
            border: none;
            padding: 1rem;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1rem;
            color: #0A0E17;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 0.5rem;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(56, 189, 248, 0.3);
        }
        
        /* Status Alert */
        .status-alert {
            margin-top: 1.5rem;
            padding: 1rem;
            border-radius: 12px;
            display: none;
        }
        .status-alert.success {
            background: rgba(16, 185, 129, 0.1);
            border-left: 4px solid #10B981;
            color: #10B981;
        }
        
        /* Transaction Table */
        .history-section {
            margin-top: 2rem;
            background: #0F172A;
            border: 1px solid #1E293B;
            border-radius: 20px;
            overflow: hidden;
        }
        .history-header {
            padding: 1rem 1.5rem;
            background: #1E293B;
            border-bottom: 1px solid #1E293B;
        }
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }
        .history-table th, .history-table td {
            padding: 1rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid #1E293B;
        }
        .history-table th {
            color: #94A3B8;
            font-weight: 500;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        .status-completed { color: #10B981; }
        .status-pending { color: #F59E0B; }
        
        @media (max-width: 768px) {
            .premium-header { flex-direction: column; gap: 0.5rem; text-align: center; }
            .address-box { flex-direction: column; text-align: center; }
            .history-table th, .history-table td { padding: 0.75rem 1rem; }
        }
    </style>
</head>
<body>

<header class="premium-header">
    <a href="<?php echo base_url('webtask'); ?>" class="logo">ARBITRA<span style="color:#38BDF8;">WISE</span></a>
    <div class="user-info">
        <div class="welcome-badge">👋 Welcome, <?php echo $deposit['username']; ?></div>
        <div class="balance-badge">💰 $<?php echo number_format($deposit['pack_balance'] ?? 0, 2); ?></div>
    </div>
</header>

<div class="deposit-container">
    <div class="premium-card">
        <div class="card-header">
            <h2><i class="fas fa-arrow-down" style="color: #10B981;"></i> Deposit Funds</h2>
        </div>
        <div class="card-body">
            <!-- Instructions -->
            <div class="info-box">
                <h4><i class="fas fa-info-circle"></i> Important Information</h4>
                <p>• <strong>Minimum Deposit:</strong> $50 USDT</p>
                <p>• <strong>Network:</strong> TRC20 (Tron) – <span style="color:#F59E0B;">Sending on other networks will result in permanent loss!</span></p>
                <p>• <strong>Processing Time:</strong> 5-10 minutes after blockchain confirmation</p>
                <p>• Funds are automatically credited to your trading balance</p>
            </div>
            
            <!-- Deposit Address -->
            <div class="address-box">
                <code id="depositAddress">TWzEJEHJK4frz25CavqU8uoD97jfwzs2YLg</code>
                <button class="copy-btn" onclick="copyAddress()"><i class="fas fa-copy"></i> Copy Address</button>
            </div>
            
            <!-- Amount Input -->
            <div class="form-group">
                <label><i class="fas fa-dollar-sign"></i> Amount (USDT)</label>
                <input type="number" id="depositAmount" class="form-control" placeholder="Enter amount (min $50)" min="50" step="10">
            </div>
            
            <!-- Submit Button -->
            <button class="submit-btn" onclick="submitDeposit()"><i class="fas fa-paper-plane"></i> Submit Deposit Request</button>
            
            <!-- Status Message -->
            <div id="depositStatus" class="status-alert success">
                <i class="fas fa-check-circle"></i> Deposit request submitted! Funds will be credited within 5-10 minutes.
            </div>
        </div>
    </div>
    
    <!-- Transaction History -->
    <div class="history-section">
        <div class="history-header">
            <h3 style="margin:0;"><i class="fas fa-history"></i> Deposit History</h3>
        </div>
        <table class="history-table">
            <thead>
                <tr><th>ID</th><th>Amount</th><th>Hash</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php if(isset($deposit['completedata']) && !empty($deposit['completedata'])): ?>
                    <?php foreach ($deposit['completedata'] as $cmpdata): ?>
                    <tr>
                        <td>#<?php echo $cmpdata->id; ?></td>
                        <td><?php echo $cmpdata->credit_packs; ?> Credits</td>
                        <td><code style="font-size:11px;"><?php echo substr($cmpdata->hash, 0, 15); ?>...</code></td>
                        <td class="status-<?php echo $cmpdata->status; ?>"><?php echo ucfirst($cmpdata->status); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center;">No deposit history yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function copyAddress() {
    var copyText = document.getElementById('depositAddress').innerText;
    navigator.clipboard.writeText(copyText);
    alert('✅ Address copied to clipboard:\n' + copyText);
}

function submitDeposit() {
    var amount = document.getElementById('depositAmount').value;
    if (!amount || amount < 50) {
        alert('❌ Minimum deposit is $50 USDT');
        return;
    }
    
    var address = document.getElementById('depositAddress').innerText;
    var statusDiv = document.getElementById('depositStatus');
    
    statusDiv.style.display = 'block';
    
    alert('📌 Please send ' + amount + ' USDT to:\n\n' + address + '\n\n⚠️ Send ONLY on TRC20 network!\n\nYour balance will be updated automatically after confirmation.');
    
    // Optional: Auto-hide status after 5 seconds
    setTimeout(function() {
        statusDiv.style.display = 'none';
    }, 5000);
}
</script>

</body>
</html>
