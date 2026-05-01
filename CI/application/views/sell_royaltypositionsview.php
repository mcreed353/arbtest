<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArbitrageWise - Withdraw Funds</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0A0E17; color: #E5E7EB; font-family: 'Inter', sans-serif; }
        
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
        .withdraw-container {
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
            border-left: 4px solid #F59E0B;
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
            background: linear-gradient(135deg, #F59E0B, #D97706);
            border: none;
            padding: 1rem;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 0.5rem;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        }
        
        /* Fee Breakdown */
        .fee-breakdown {
            background: #1E293B;
            border-radius: 16px;
            padding: 1rem;
            margin: 1rem 0;
        }
        .fee-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #334155;
        }
        .fee-row:last-child {
            border-bottom: none;
        }
        .fee-total {
            color: #F59E0B;
            font-weight: bold;
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
        .status-alert.error {
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid #EF4444;
            color: #EF4444;
        }
        
        @media (max-width: 768px) {
            .premium-header { flex-direction: column; gap: 0.5rem; text-align: center; }
        }
    </style>
</head>
<body>

<header class="premium-header">
    <a href="<?php echo base_url('webtask'); ?>" class="logo">ARBITRA<span style="color:#38BDF8;">WISE</span></a>
    <div class="user-info">
        <div class="welcome-badge">👋 Welcome, <?php echo $sell_rp['username']; ?></div>
        <div class="balance-badge">💰 $<?php echo number_format($sell_rp['current_balance'] ?? 0, 2); ?></div>
    </div>
</header>

<div class="withdraw-container">
    <div class="premium-card">
        <div class="card-header">
            <h2><i class="fas fa-arrow-up" style="color: #F59E0B;"></i> Withdraw Funds</h2>
        </div>
        <div class="card-body">
            <!-- Instructions -->
            <div class="info-box">
                <h4><i class="fas fa-info-circle"></i> Withdrawal Information</h4>
                <p>• <strong>Minimum Withdrawal:</strong> $50 USDT</p>
                <p>• <strong>Processing Fee:</strong> 5% of withdrawal amount</p>
                <p>• <strong>Processing Time:</strong> 24-48 hours</p>
                <p>• Funds will be sent to your provided USDT (TRC20) address</p>
            </div>
            
            <!-- Fee Calculator -->
            <div class="fee-breakdown" id="feeBreakdown">
                <div class="fee-row">
                    <span>Withdrawal Amount:</span>
                    <span>$<span id="displayAmount">0.00</span></span>
                </div>
                <div class="fee-row">
                    <span>Processing Fee (5%):</span>
                    <span>$<span id="displayFee">0.00</span></span>
                </div>
                <div class="fee-row">
                    <span class="fee-total">You Will Receive:</span>
                    <span class="fee-total">$<span id="displayNet">0.00</span></span>
                </div>
            </div>
            
            <!-- Withdrawal Form -->
            <form method="post" action="<?php echo base_url('marketplace/sell_royaltypositions'); ?>" id="withdrawForm">
                <div class="form-group">
                    <label><i class="fas fa-dollar-sign"></i> Amount (USDT)</label>
                    <input type="number" name="withdraw_amount" id="withdrawAmount" class="form-control" placeholder="Enter amount (min $50)" min="50" step="10" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-wallet"></i> USDT (TRC20) Wallet Address</label>
                    <input type="text" name="wallet_address" id="walletAddress" class="form-control" placeholder="Enter your USDT TRC20 address" required>
                </div>
                
                <button type="submit" name="request_withdrawal" class="submit-btn" onclick="return validateWithdraw()">
                    <i class="fas fa-paper-plane"></i> Request Withdrawal
                </button>
            </form>
            
            <!-- Status Message -->
            <div id="withdrawStatus" class="status-alert success">
                <i class="fas fa-check-circle"></i> Withdrawal request submitted! You will receive updates via Telegram.
            </div>
        </div>
    </div>
</div>

<script>
// Calculate fee in real-time
const amountInput = document.getElementById('withdrawAmount');
const displayAmount = document.getElementById('displayAmount');
const displayFee = document.getElementById('displayFee');
const displayNet = document.getElementById('displayNet');

function calculateFee() {
    let amount = parseFloat(amountInput.value) || 0;
    let fee = amount * 0.05;
    let net = amount - fee;
    
    displayAmount.innerText = amount.toFixed(2);
    displayFee.innerText = fee.toFixed(2);
    displayNet.innerText = net.toFixed(2);
}

amountInput.addEventListener('input', calculateFee);

function validateWithdraw() {
    let amount = parseFloat(amountInput.value) || 0;
    let address = document.getElementById('walletAddress').value;
    
    if (amount < 50) {
        alert('❌ Minimum withdrawal amount is $50 USDT');
        return false;
    }
    
    let maxBalance = <?php echo (float)($sell_rp['current_balance'] ?? 0); ?>;
    if (amount > maxBalance) {
        alert('❌ Insufficient balance. You have $' + maxBalance.toFixed(2) + ' available.');
        return false;
    }
    
    if (!address || address.length < 10) {
        alert('❌ Please enter a valid USDT (TRC20) wallet address');
        return false;
    }
    
    let fee = amount * 0.05;
    let net = amount - fee;
    
    return confirm(`📌 Confirm Withdrawal\n\nAmount: $${amount.toFixed(2)}\nFee (5%): $${fee.toFixed(2)}\nNet Amount: $${net.toFixed(2)}\n\nAddress: ${address}\n\nWithdrawals are processed within 24-48 hours.`);
}
</script>

</body>
</html>
