<?php

/**
 * @package   Functional-php
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://github.com/lstrojny/functional-php
 */

namespace Functional;

final class Functional
{
    /**
     * @see \Function\ary
     */
    public const ary = '\Functional\ary';

    /**
     * @see \Functional\average
     */
    public const average = '\Functional\average';

    /**
     * @see \Functional\but_last
     */
    public const but_last = '\Functional\but_last';

    /**
     * @see \Functional\capture
     */
    public const capture = '\Functional\capture';

    /**
     * @see \Functional\compare_object_hash_on
     */
    public const compare_object_hash_on = '\Functional\compare_object_hash_on';

    /**
     * @see \Functional\compare_on
     */
    public const compare_on = '\Functional\compare_on';

    /**
     * @see \Functional\compose
     */
    public const compose = '\Functional\compose';

    /**
     * @see \Functional\concat
     */
    public const concat = '\Functional\concat';

    /**
     * @see \Functional\const_function
     */
    public const const_function = '\Functional\const_function';

    /**
     * @see \Functional\contains
     */
    public const contains = '\Functional\contains';

    /**
     * @see \Functional\converge
     */
    public const converge = '\Functional\converge';

    /**
     * @see \Functional\curry
     */
    public const curry = '\Functional\curry';

    /**
     * @see \Functional\curry_n
     */
    public const curry_n = '\Functional\curry_n';

    /**
     * @see \Functional\difference
     */
    public const difference = '\Functional\difference';

    /**
     * @see \Functional\drop_first
     */
    public const drop_first = '\Functional\drop_first';

    /**
     * @see \Functional\drop_last
     */
    public const drop_last = '\Functional\drop_last';

    /**
     * @see \Functional\each
     */
    public const each = '\Functional\each';

    /**
     * @see \Functional\entries
     */
    public const entries = '\Functional\entries';

    /**
     * @see \Functional\equal
     */
    public const equal = '\Functional\equal';

    /**
     * @see \Functional\error_to_exception
     */
    public const error_to_exception = '\Functional\error_to_exception';

    /**
     * @see \Functional\every
     */
    public const every = '\Functional\every';

    /**
     * @see \Functional\false
     */
    public const false = '\Functional\false';

    /**
     * @see \Functional\falsy
     */
    public const falsy = '\Functional\falsy';

    /**
     * @see \Functional\filter
     */
    public const filter = '\Functional\filter';

    /**
     * @see \Functional\first
     */
    public const first = '\Functional\first';

    /**
     * @see \Functional\first_index_of
     */
    public const first_index_of = '\Functional\first_index_of';

    /**
     * @see \Functional\flat_map
     */
    public const flat_map = '\Functional\flat_map';

    /**
     * @see \Functional\flatten
     */
    public const flatten = '\Functional\flatten';

    /**
     * @see \Functional\flip
     */
    public const flip = '\Functional\flip';

    /**
     * @see \Functional\from_entries
     */
    public const from_entries = '\Functional\from_entries';

    /**
     * @see \Functional\greater_than
     */
    public const greater_than = '\Functional\greater_than';

    /**
     * @see \Functional\greater_than_or_equal
     */
    public const greater_than_or_equal = '\Functional\greater_than_or_equal';

    /**
     * @see \Functional\group
     */
    public const group = '\Functional\group';

    /**
     * @see \Functional\head
     */
    public const head = '\Functional\head';

    /**
     * @see \Functional\id
     */
    public const id = '\Functional\id';

    /**
     * @see \Functional\identical
     */
    public const identical = '\Functional\identical';

    /**
     * @see \Functional\if_else
     */
    public const if_else = '\Functional\if_else';

    /**
     * @see \Functional\indexes_of
     */
    public const indexes_of = '\Functional\indexes_of';

    /**
     * @see \Functional\intersperse
     */
    public const intersperse = '\Functional\intersperse';

    /**
     * @see \Functional\invoke
     */
    public const invoke = '\Functional\invoke';

    /**
     * @see \Functional\invoke_first
     */
    public const invoke_first = '\Functional\invoke_first';

    /**
     * @see \Functional\invoke_if
     */
    public const invoke_if = '\Functional\invoke_if';

    /**
     * @see \Functional\invoke_last
     */
    public const invoke_last = '\Functional\invoke_last';

    /**
     * @see \Functional\invoker
     */
    public const invoker = '\Functional\invoker';

    /**
     * @see \Functional\last
     */
    public const last = '\Functional\last';

    /**
     * @see \Functional\last_index_of
     */
    public const last_index_of = '\Functional\last_index_of';

    /**
     * @see \Functional\less_than
     */
    public const less_than = '\Functional\less_than';

    /**
     * @see \Functional\less_than_or_equal
     */
    public const less_than_or_equal = '\Functional\less_than_or_equal';

    /**
     * @see \Functional\lexicographic_compare
     */
    public const lexicographic_compare = '\Functional\lexicographic_compare';

    /**
     * @see \Functional\map
     */
    public const map = '\Functional\map';

    /**
     * @see \Functional\matching
     * @deprecated
     */
    public const match = '\Functional\match';

    /**
     * @see \Functional\matching
     */
    public const matching = '\Functional\matching';

    /**
     * @see \Functional\maximum
     */
    public const maximum = '\Functional\maximum';

    /**
     * @see \Functional\memoize
     */
    public const memoize = '\Functional\memoize';

    /**
     * @see \Functional\minimum
     */
    public const minimum = '\Functional\minimum';

    /**
     * @see \Functional\none
     */
    public const none = '\Functional\none';

    /**
     * @see \Functional\noop
     */
    public const noop = '\Functional\noop';

    /**
     * @see \Functional\not
     */
    public const not = '\Functional\not';

    /**
     * @see \Functional\omit_keys
     */
    public const omit_keys = '\Functional\omit_keys';

    /**
     * @see \Functional\partial_any
     */
    public const partial_any = '\Functional\partial_any';

    /**
     * @see \Functional\…
     */
    public const … = '\Functional\…';

    /**
     * @see \Functional\placeholder
     */
    public const placeholder = '\Functional\placeholder';

    /**
     * @see \Functional\partial_left
     */
    public const partial_left = '\Functional\partial_left';

    /**
     * @see \Functional\partial_method
     */
    public const partial_method = '\Functional\partial_method';

    /**
     * @see \Functional\partial_right
     */
    public const partial_right = '\Functional\partial_right';

    /**
     * @see \Functional\partition
     */
    public const partition = '\Functional\partition';

    /**
     * @see \Functional\pick
     */
    public const pick = '\Functional\pick';

    /**
     * @see \Functional\pluck
     */
    public const pluck = '\Functional\pluck';

    /**
     * @see \Functional\poll
     */
    public const poll = '\Functional\poll';

    /**
     * @see \Functional\product
     */
    public const product = '\Functional\product';

    /**
     * @see \Functional\ratio
     */
    public const ratio = '\Functional\ratio';

    /**
     * @see \Functional\reduce_left
     */
    public const reduce_left = '\Functional\reduce_left';

    /**
     * @see \Functional\reduce_right
     */
    public const reduce_right = '\Functional\reduce_right';

    /**
     * @see \Functional\reindex
     */
    public const reindex = '\Functional\reindex';

    /**
     * @see \Functional\reject
     */
    public const reject = '\Functional\reject';

    /**
     * @see \Functional\repeat
     */
    public const repeat = '\Functional\repeat';

    /**
     * @see \Functional\retry
     */
    public const retry = '\Functional\retry';

    /**
     * @see \Functional\select
     */
    public const select = '\Functional\select';

    /**
     * @see \Functional\select_keys
     */
    public const select_keys = '\Functional\select_keys';

    /**
     * @see \Functional\sequence_constant
     */
    public const sequence_constant = '\Functional\sequence_constant';

    /**
     * @see \Functional\sequence_exponential
     */
    public const sequence_exponential = '\Functional\sequence_exponential';

    /**
     * @see \Functional\sequence_linear
     */
    public const sequence_linear = '\Functional\sequence_linear';

    /**
     * @see \Functional\some
     */
    public const some = '\Functional\some';

    /**
     * @see \Functional\sort
     */
    public const sort = '\Functional\sort';

    /**
     * @see \Functional\sum
     */
    public const sum = '\Functional\sum';

    /**
     * @see \Functional\suppress_error
     */
    public const suppress_error = '\Functional\suppress_error';

    /**
     * @see \Functional\tail
     */
    public const tail = '\Functional\tail';

    /**
     * @see \Functional\tail_recursion
     */
    public const tail_recursion = '\Functional\tail_recursion';

    /**
     * @see \Functional\take_left
     */
    public const take = '\Functional\take_left';

    /**
     * @see \Functional\take_right
     */
    public const take_right = '\Functional\take_right';

    /**
     * @see \Functional\tap
     */
    public const tap = '\Functional\tap';

    /**
     * @see \Functional\true
     */
    public const true = '\Functional\true';

    /**
     * @see \Functional\truthy
     */
    public const truthy = '\Functional\truthy';

    /**
     * @see \Functional\unique
     */
    public const unique = '\Functional\unique';

    /**
     * @see \Functional\value_to_key
     */
    public const value_to_key = '\Functional\value_to_key';

    /**
     * @see \Functional\with
     */
    public const with = '\Functional\with';

    /**
     * @see \Functional\zip
     */
    public const zip = '\Functional\zip';

    /**
     * @see \Functional\zip_all
     */
    public const zip_all = '\Functional\zip_all';

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
