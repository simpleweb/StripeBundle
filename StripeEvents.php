<?php

namespace Simpleweb\StripeBundle;

/**
 * Contains all Stripe events thrown in the SimplewebStripeBundle
 */
final class StripeEvents
{
    const ACCOUNT_UPDATED                      = 'simpleweb_stripe.account.updated';
    const ACCOUNT_APPLICATION_DEAUTHORIZED     = 'simpleweb_stripe.account.application.deauthorized';
    const APPLICATION_FEE_CREATED              = 'simpleweb_stripe.application_fee.created';
    const APPLICATION_FEE_REFUNDED             = 'simpleweb_stripe.application_fee.refunded';
    const BALANCE_AVAILABLE                    = 'simpleweb_stripe.balance.available';
    const CHARGE_SUCCEEDED                     = 'simpleweb_stripe.charge.succeeded';
    const CHARGE_FAILED                        = 'simpleweb_stripe.charge.failed';
    const CHARGE_REFUNDED                      = 'simpleweb_stripe.charge.refunded';
    const CHARGE_CAPTURED                      = 'simpleweb_stripe.charge.captured';
    const CHARGE_UPDATED                       = 'simpleweb_stripe.charge.updated';
    const CHARGE_DISPUTE_CREATED               = 'simpleweb_stripe.charge.dispute.created';
    const CHARGE_DISPUTE_UPDATED               = 'simpleweb_stripe.charge.dispute.updated';
    const CHARGE_DISPUTE_CLOSED                = 'simpleweb_stripe.charge.dispute.closed';
    const CUSTOMER_CREATED                     = 'simpleweb_stripe.customer.created';
    const CUSTOMER_UPDATED                     = 'simpleweb_stripe.customer.updated';
    const CUSTOMER_DELETED                     = 'simpleweb_stripe.customer.deleted';
    const CUSTOMER_CARD_CREATED                = 'simpleweb_stripe.customer.card.created';
    const CUSTOMER_CARD_UPDATED                = 'simpleweb_stripe.customer.card.updated';
    const CUSTOMER_CARD_DELETED                = 'simpleweb_stripe.customer.card.deleted';
    const CUSTOMER_SUBSCRIPTION_CREATED        = 'simpleweb_stripe.customer.subscription.created';
    const CUSTOMER_SUBSCRIPTION_UPDATED        = 'simpleweb_stripe.customer.subscription.updated';
    const CUSTOMER_SUBSCRIPTION_DELETED        = 'simpleweb_stripe.customer.subscription.deleted';
    const CUSTOMER_SUBSCRIPTION_TRIAL_WILL_END = 'simpleweb_stripe.customer.subscription.trial_will_end';
    const CUSTOMER_DISCOUNT_CREATED            = 'simpleweb_stripe.customer.discount.created';
    const CUSTOMER_DISCOUNT_UPDATED            = 'simpleweb_stripe.customer.discount.updated';
    const CUSTOMER_DISCOUNT_DELETED            = 'simpleweb_stripe.customer.discount.deleted';
    const INVOICE_CREATED                      = 'simpleweb_stripe.invoice.created';
    const INVOICE_UPDATED                      = 'simpleweb_stripe.invoice.updated';
    const INVOICE_PAYMENT_SUCCEEDED            = 'simpleweb_stripe.invoice.payment_succeeded';
    const INVOICE_PAYMENT_FAILED               = 'simpleweb_stripe.invoice.payment_failed';
    const INVOICEITEM_CREATED                  = 'simpleweb_stripe.invoiceitem.created';
    const INVOICEITEM_UPDATED                  = 'simpleweb_stripe.invoiceitem.updated';
    const INVOICEITEM_DELETED                  = 'simpleweb_stripe.invoiceitem.deleted';
    const PLAN_CREATED                         = 'simpleweb_stripe.plan.created';
    const PLAN_UPDATED                         = 'simpleweb_stripe.plan.updated';
    const PLAN_DELETED                         = 'simpleweb_stripe.plan.deleted';
    const COUPON_CREATED                       = 'simpleweb_stripe.coupon.created';
    const COUPON_DELETED                       = 'simpleweb_stripe.coupon.deleted';
    const TRANSFER_CREATED                     = 'simpleweb_stripe.transfer.created';
    const TRANSFER_UPDATED                     = 'simpleweb_stripe.transfer.updated';
    const TRANSFER_PAID                        = 'simpleweb_stripe.transfer.paid';
    const TRANSFER_FAILED                      = 'simpleweb_stripe.transfer.failed';
    const PING                                 = 'simpleweb_stripe.ping';
}
