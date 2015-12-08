<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    if(count($expense_per_month_array) > 0 || count($expense_per_category_array) > 0):
?>
                <h2>Expenses</h2>
                <p><?php echo $expenses_message; ?></p>
                <div class="tabs-container">
                    <ul class="tabs">
                        <li id="per-month" class="tab-trigger active">Per Month</li>
                        <li id="per-category" class="tab-trigger">Per Category</li>
                    </ul>
                    <div class="content">
                    <?php 
                        if(count($expense_per_month_array) > 0):
                            $total_pre_tax_amount = 0;
                            $total_tax_amount = 0;
                            $total_post_tax_amount = 0;
                        
                    ?>
                        <div id="per-month-content" class="tab-content db">
                            <table>
                                <thead>
                                    <tr>
                                        <td class="col-1">Month</td>
                                        <td class="col-2">Pre-Tax Amount ($)</td>
                                        <td class="col-3">Tax Amount ($)</td>
                                        <td class="col-4">Post-Tax Amount ($)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $calender_info = cal_info(0);
                                    foreach($calender_info['months'] as $key => $val):
                                        $pre_tax_amount = 0;
                                        $tax_amount = 0;
                                        $post_tax_amount = 0;
                                        foreach($expense_per_month_array as $data):
                                            if($data['auction_month'] == $key):
                                                $pre_tax_amount = $data['pre_tax_amount'];
                                                $tax_amount = $data['tax_amount'];
                                                $post_tax_amount = $data['pre_tax_amount'] + $data['tax_amount'];
                                                break;
                                            endif;
                                        endforeach;
                                ?>                
                                    <tr>
                                        <td><?php echo $val; ?></td>
                                        <td class="col-num"><?php echo number_format($pre_tax_amount, 2); ?></td>
                                        <td class="col-num"><?php echo number_format($tax_amount, 2); ?></td>
                                        <td class="col-num"><?php echo number_format($post_tax_amount, 2); ?></td>
                                    </tr>
                                <?php 
                                        $total_pre_tax_amount += $pre_tax_amount;
                                        $total_tax_amount += $tax_amount;
                                        $total_post_tax_amount += $post_tax_amount;
                                    endforeach;
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td class="col-num"><?php echo number_format($total_pre_tax_amount, 2); ?></td>
                                        <td class="col-num"><?php echo number_format($total_tax_amount, 2); ?></td>
                                        <td class="col-num"><?php echo number_format($total_post_tax_amount, 2); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                                else:
                                    echo 'No expense information information in the system yet.';
                                endif;
                            ?>
                        </div>
                            <?php
                                if(count($expense_per_category_array) > 0):    
                            ?>
                        <div id="per-category-content" class="tab-content dn">
                            <table>
                                <thead>
                                    <tr>
                                        <td class="col-1">Month</td>
                                        <td class="col-2">Pre-Tax Amount ($)</td>
                                        <td class="col-3">Tax Amount ($)</td>
                                        <td class="col-4">Post-Tax Amount ($)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total_pre_tax_amount = 0;
                                    $total_tax_amount = 0;
                                    $total_post_tax_amount = 0;
                                    foreach($expense_per_category_array as $data):
                                        $post_tax_amount = $data['pre_tax_amount'] + $data['tax_amount'];
                                ?>
                                    <tr>
                                        <td><?php echo $data['category_name']; ?></td>
                                        <td class="col-num"><?php echo number_format($data['pre_tax_amount'], 2); ?></td>
                                        <td class="col-num"><?php echo number_format($data['tax_amount'], 2); ?></td>
                                        <td class="col-num"><?php echo number_format($post_tax_amount, 2); ?></td>
                                    </tr>
                                <?php
                                        $total_pre_tax_amount += $data['pre_tax_amount'];
                                        $total_tax_amount += $data['tax_amount'];
                                        $total_post_tax_amount += $post_tax_amount;
                                    endforeach;
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td class="col-num"><?php echo number_format($total_pre_tax_amount, 2); ?></td>
                                        <td class="col-num"><?php echo number_format($total_tax_amount, 2); ?></td>
                                        <td class="col-num"><?php echo number_format($total_post_tax_amount, 2); ?></td>
                                        </tr>
                                </tfoot>
                            </table>
                            <?php 
                                else:
                                    echo 'No expense information information in the system yet.';
                                endif; 
                            ?>
                        </div>
                    </div>
                </div>
<?php 
    endif; 
?>