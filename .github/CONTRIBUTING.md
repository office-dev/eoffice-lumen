# Contributing to EOffice

First, thank you for contributing, you're awesome!

To have your code integrated in the EOffice project, there are some rules to follow, but don't panic, it's easy!

## Reporting Bugs

If you happen to find a bug, we kindly request you to report it. However, before submitting it, please:

* Check the [project documentation available online](https://github.com/office-dev/eoffice/wiki)

Then, if it appears that it's a real bug, you may report it using Github by following these 3 points:

* Check if the bug is not already reported!
* A clear title to resume the issue
* A description of the workflow needed to reproduce the bug,

> _NOTE:_ Don’t hesitate to give as much information as you can (OS, PHP version extensions...)

## Pull Requests

### Writing a Pull Request

You should base your changes on the `main` branch.

### Matching Coding Standards

The EOffice project follows [PSR Coding Standard](https://www.php-fig.org/psr/).
But don't worry, you can fix CS issues automatically using the [PHP CS Fixer](http://cs.sensiolabs.org/) tool:

```bash
./vendor/bin/php-cs-fixer fix
```

And then, add fixed file to your commit before push.
Be sure to add only **your modified files**. If another files are fixed by cs tools, just revert it before commit.

### Sending a Pull Request

When you send a PR, just make sure that:

* You add valid test cases.
* Tests are green.
* You make the PR on the same branch you based your changes on. If you see commits
  that you did not make in your PR, you're doing it wrong.
* Squash your commits into one commit. (see the next chapter)

Fill in the following header from the pull request template:

```markdown
| Q             | A
| ------------- | ---
| Bug fix?      | yes/no
| New feature?  | yes/no
| BC breaks?    | no
| Deprecations? | no
| Tests pass?   | yes
| Fixed tickets | #1234, #5678
| License       | MIT
| Doc PR        | api-platform/docs#1234
```

## Squash your Commits

If you have 3 commits. So start with:

```bash
git rebase -i HEAD~3
```

An editor will be opened with your 3 commits, all prefixed by `pick`.

Replace all `pick` prefixes by `fixup` (or `f`) **except the first commit** of the list.

Save and quit the editor.

After that, all your commits where squashed into the first one and the commit message of the first commit.

If you would like to rename your commit message type:

```bash
git commit --amend
```

Now force push to update your PR:

```bash
git push --force
```

# License and Copyright Attribution

When you open a Pull Request to the EOffice project, you agree to license your code under the [MIT license](../LICENSE)
and to transfer the copyright on the submitted code to [Anthonius Munthi](https://github.com/kilip).

Be sure to you have the right to do that (if you are a professional, ask your company)!

If you include code from another project, please mention it in the Pull Request description and credit the original author.
